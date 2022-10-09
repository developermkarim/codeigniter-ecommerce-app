<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\Files\File;

class ProductController extends BaseController
{ 

    public function index()
    {
        $prod_model = new ProductModel();
        $cat_model = new CategoryModel();
        $data = [];
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $productByCategory = [
                'cat_name' => $this->request->getVar('category_name'),
            ];
            if($prod_model->save($productByCategory)){
                $data['Flash_message'] = true;
            }
        }

        $data['categories'] = $cat_model->findAll();
        $data['admin_content'] = 'admin/product';
       return view('admin/includes/template',$data);

    }

    public function product()
    {
        $data = [];
        helper(['form','url']);
        $model = new ProductModel();
      if($this->request->getMethod() == 'post'){


        $file = $this->request->getFile('product_image');
        if($file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move("uploads/",$newName);
        }
        $productData = [
            'fk_catid' =>$this->request->getVar('fk_catid'),
            'product_name' =>$this->request->getVar('product_name'),
            'MRP' =>$this->request->getVar('MRP'),
            'selling_price' =>$this->request->getVar('selling_price'),
            'image' => $newName,
            'qty' =>$this->request->getVar('qty'),
            'product_desc' =>$this->request->getVar('product_desc'),
        ];

        if($model->save($productData)){
            $data['Flash_message'] = TRUE;
           
          
        }else{
            $data['Flash_message'] = FALSE;
        }
      }

      
    $data['admin_content'] = 'admin/product';
    return view('admin/includes/template',$data);
    exit;
    }


    public function allProductList()
    {
        $data = [];
        $pdModel = new ProductModel();
        
        $data['admin_content'] = 'admin/productList';
        $data['allProducts'] = $pdModel->findAll();
        return view('admin/includes/template',$data);
    }

    public function allCategoryList()
    {
        $data = [];
        $catModel = new CategoryModel();
        $data['admin_content'] = 'admin/categoryList';
        $data['allCategories'] = $catModel->findAll();
        return view('admin/includes/template',$data);
    }

   
}

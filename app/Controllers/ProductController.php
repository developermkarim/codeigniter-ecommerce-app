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

        $validRules = [
            'product_image'=>[
                'label' =>'image file',
                'rules'=>'uploaded[product_image]' . '|is_image[product_image]'. '|mime_in[product_image,image/jpg,image/png,image/jpeg]',

            ],
        ];
        if(!$this->validate($validRules)){
            $data['validation'] = $this->validator;
        }
        else{

            $img = $this->request->getFile('product_image');
            if(!$img->hasMoved()){
                $filepath = WRITEPATH .'uploads/'. $img->store();
                $uploaded_fileinfo = new File($filepath);
                $file_name = esc($uploaded_fileinfo->getBasename());
            }
        }
       
        $productData = [
            'fk_catid' =>$this->request->getVar('fk_catid'),
            'product_name' =>$this->request->getVar('product_name'),
            'MRP' =>$this->request->getVar('MRP'),
            'selling_price' =>$this->request->getVar('selling_price'),
            'image' => $file_name,
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

   
}

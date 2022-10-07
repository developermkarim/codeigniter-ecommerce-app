<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class Home extends BaseController
{

 
   public function home()
   {
    $data = [];
    $model = new CategoryModel();
    $data['cat_menu'] = $model->findAll();
    // print_r($data);
    return view('home',$data);
   }
   public function signin()
   {

    return view('login');
   }
   public function signup()
   {
    $data =   [];
    helper('form');


    if($this->request->getMethod() == 'post'){

        $rules = [
            'firstname' => 'required|min_length[5]|max_length[20]',
            'lastname' => 'required|min_length[5]|max_length[20]',
            'email'    => 'required|valid_email|is_unique[admin.email]',
            'password' =>'required|min_length[5]|max_length[10]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('signup', [
                'validation' => $this->validator,
            ]);
        }
        else{
            $model = new AdminModel();
            
            $insertData = [
                'firstname' => $this->request->getVar('firstname'),
                'lastname'=>$this->request->getVar('lastname'),
                'email'=>$this->request->getVar('email'),
                'password'=> $this->request->getVar('password'),
             

            ];

          if($model->save($insertData)){
            $data['success_data'] = true;
             return view('signup',$data);
          }

          redirect()->to('/');
        }

    }
   }

   public function dashboard()
   {
   return view('dashboard');
   }

   public function logout()
   {
    session_destroy();
    session_unset();
    return view('login');
   }

   /*  public function index()
    {
        $data = [];
        $helper = ['form'];
        if($this->request->getMethod() == 'post'){
            $rules = [
                'email'=>'required|min_length|max_length|valid_email',
                'password'=>'required|min_length[8]|max_length[255]',
            ];
            $errors = [
                'password'=>[
                    'validateUser'=>'Email or Password does\'t match',
                ]
                ];

                if(!$this->request->validate($rules,$errors)){

                    $data['validation'] = $this->validator;
                }

                else{

                    $model = new AdminModel();
                    $admin = $model->where('email',$this->request->getVar('emailo'))->first();

                  /*   if($this->varifyMypassword($this->request->getVar('password')), $admin['']); */
                

        
       // return view('login');

       public function productList($id)
       {
        $data = [];
        
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();
        $data['category'] = $categoryModel->findAll();
        $data['product'] = $productModel->where('fk_catid',$id)->findAll();
        // $data['main _content'] = 'product';
        return view('product',$data);
       }


       public function productDetails($id)
       {
        $data = [];
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $data['category'] =  $categoryModel->findAll();
        $data['productDetals'] = $productModel->where('id',$id)->first();
        return view('productDetails',$data);
        
       }
     
}

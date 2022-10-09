<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use PhpParser\Node\Expr\Cast\Object_;

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

       public function addToCart()
       {
       
       $cartModel = new CartModel();
        $jsonData =  [];
        if($this->request->getMethod()=='post'){
            $productId = $this->request->getVar('productId');
            $userId = $this->request->getVar('userId');
            $cartData = [
               'fk_product_id'=> $this->request->getVar('productId'),
               'qyt'=>1,
               'cost'=>$this->request->getVar('pdCost'),
               'user_id'=>$this->request->getVar('userId'),

            ];
          $productDetails = $cartModel->where('fk_product_id',$productId)->where('user_id',$userId)->findAll();
         if((count($productDetails)) == 1){
            // print_r($productDetails[0]['qyt']);
            $oldtqty = $productDetails[0]['qyt'];
            $id = $productDetails[0]['id'];
            $updatedCart = [
                'qyt' => $oldtqty + 1,
            ];
        

            
           if($cartModel->update($id,$updatedCart)) {
            $jsonData = ['status'=>'success','qty'=>$oldtqty];
           }
           else{
            $jsonData  = ['status'=>'error'];
           }

          }
           else{
           if($cartModel->save($cartData)){
            $jsonData = ['status'=>'success','qty'=> 1];
           }
           else{
            $jsonData = ['status'=>'error'];
           }
           
           }

           echo json_encode($jsonData);
        //    print_r($jsonData);exit;
        }

        }
       
       
        public function cartIncrement()
        {
            $incrementStatus = [];
            $cartModel = new CartModel();
            if($this->request->getMethod()=='post'){
                $productId = $this->request->getVar('productId');
                $userId = $this->request->getVar('userId');

                $productDetails = $cartModel->where('fk_product_id',$productId)->where('user_id',$userId)->findAll();
                $pdQty = $productDetails[0]['qyt'];
                $id = $productDetails[0]['id'];
                if(count($productDetails) ==1){

                }
                else{
                    $updateQyt = [
                        'qyt'=>$pdQty -1
                    ];
                    if($cartModel->update($id,$updateQyt)){
                        $incrementStatus = array('status'=>'success','qyt'=>$pdQty-1);
                    }
                    else{
                        echo 2;
                    }

                }
               /*  $cartData = [
                   'fk_product_id'=> $this->request->getVar('productId'),
                   'user_id'=>$this->request->getVar('userId'),
    
                ]; */

                echo json_encode($incrementStatus);
            }
        }

     
}

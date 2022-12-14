<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;
use App\Models\ShippingModel;

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
       public function cartProduct($id)
       {
        $data = [];
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
       
        $productModel->select('product.id, product.qty as pdQty, product.image,product.MRP, product.selling_price,cart.id as cartId,cart.qty as cartQty, cart.cost');
        $productModel->where('product.id', $id);
        $productModel->join('cart','cart.fk_product_id = product.id','left');
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
          $allCount = $cartModel->where('user_id',$userId)->countAll();
         if((count($productDetails)) == 1){
            // print_r($productDetails[0]['qyt']);
            $oldtqty = $productDetails[0]['qyt'];
            $pdPrice = $productDetails[0]['cost'];
            $id = $productDetails[0]['id'];
            $updatedCart = [
                'qyt' => $oldtqty + 1,
            ];
        

            
           if($cartModel->update($id,$updatedCart)) {
            $jsonData = ['status'=>'success','qty'=>$oldtqty,'count'=>$allCount,'price'=>$pdPrice];
           }
           else{
            $jsonData  = ['status'=>'error'];
           }

          }
           else{
           if($cartModel->save($cartData)){
            $jsonData = ['status'=>'success','qty'=> 1,'count'=>$allCount + 1];
           }
           else{
            $jsonData = ['status'=>'error'];
           }
           
           }

           echo json_encode($jsonData);
        //    print_r($jsonData);exit;
        }

        }
       
       
        public function cartdecrement()
        {
            $incrementStatus = [];
            $cartModel = new CartModel();
            if($this->request->getMethod()=='post'){
                $productId = $this->request->getVar('productId');
                $userId = $this->request->getVar('userId');

                $productDetails = $cartModel->where('fk_product_id',$productId)->where('user_id',$userId)->findAll();
                $pdQty = $productDetails[0]['qyt'];
                $id = $productDetails[0]['id'];
                if($pdQty ==1){
                    if($cartModel->where('id',$id)->delete()){
                        $incrementStatus = array('status'=>'deleted'); 
                    }
                }
                else{
                    $updateQyt = [
                        'qyt'=>$pdQty - 1
                    ];
                    if($cartModel->update($id,$updateQyt)){
                        $incrementStatus = array('status'=>'success','qyt'=>$pdQty-1);
                    }
                    else{
                        echo 2;
                    }

                }
             

                echo json_encode($incrementStatus);
            }
        }


        public function cartincrement()
        {
            $incrementStatus = [];
            $cartModel = new CartModel();
            if($this->request->getMethod()=='post'){
                $productId = $this->request->getVar('productId');
                $userId = $this->request->getVar('userId');

                $productDetails = $cartModel->where('fk_product_id',$productId)->where('user_id',$userId)->findAll();
                $pdQty = $productDetails[0]['qyt'];
                $id = $productDetails[0]['id'];
                if($pdQty ==1){
                    if($cartModel->where('id',$id)->delete()){
                        $incrementStatus = array('status'=>'deleted'); 
                    }
                }
                else{
                    $updateQyt = [
                        'qyt'=>$pdQty + 1
                    ];
                    if($cartModel->update($id,$updateQyt)){
                        $incrementStatus = array('status'=>'success','qyt'=>$pdQty-1);
                    }
                    else{
                        echo 2;
                    }

                }
             

                echo json_encode($incrementStatus);
            }
        }

        public function cart()
        {
           /*  SELECT users.id,cart.user_id, product.id, product.qty as pdQty, product.image,product.MRP, product.selling_price,cart.id as cartId,cart.qyt as cartQty, cart.cost from cart INNER JOIN product INNER JOIN users ON product.id = cart.fk_product_id WHERE cart.user_id = users.id; */

            $data = [];
            // $userSession = session()->get();
            $cartModel = new CartModel();
            $categoryModel = new CategoryModel();
            $productModel = new ProductModel();
            $productModel->select('product.id as pdId ,product.qty as pdQty,product.product_name as pdName,cart.created_at, product.image as pdImage,product.MRP, product.selling_price,cart.user_id,cart.id as cartId,cart.qyt as cartQty, cart.cost');
            $productModel->where('cart.user_id', session()->get('id'));
            $productModel->join('cart','cart.fk_product_id = product.id');
            $data['cartItems'] = $productModel->findAll();
            $data['categories'] = $categoryModel->findAll();
            $data['totalSum'] = $cartModel->countAll();
            return view('cart',$data);
        }


        public function deleteCart()
        {
            if($this->request->getMethod() == 'post'){

                $cartId = $this->request->getVar('cartId');
                $cartModel = new CartModel();
               $result =  $cartModel->where('id',$cartId)->delete();
               if($result){
                echo 'success';
                return true;
               }
               else{
                echo 'false';
                return false;
               }

        }

    }

    public function checkOut()
    {
             $data = [];
            // $userSession = session()->get();
            $cartModel = new CartModel();
            $categoryModel = new CategoryModel();
            $productModel = new ProductModel();
            $shippingModel = new ShippingModel();
            $productModel->select('product.id as pdId ,product.qty as pdQty,product.product_name as pdName,cart.created_at, product.image as pdImage,product.MRP, product.selling_price,cart.user_id,cart.id as cartId,cart.qyt as cartQty, cart.cost');
            $productModel->where('cart.user_id', session()->get('id'));
            $productModel->join('cart','cart.fk_product_id = product.id');
            $data['cartItems'] = $productModel->findAll();
            $data['categories'] = $categoryModel->findAll();
            $data['totalSum'] = $cartModel->countAll();
            $data['shippingAddress'] = $shippingModel->findAll();
            return view('checkout',$data);
    }

    public function shippingAddress()
    {
        $data =   [];
        helper('form');
        $jsonData = [];
    
        if($this->request->getMethod() == 'post'){

            // 'firstname','lastname','city','area','pincode','address','fkuser_id'
               
                $model = new ShippingModel();
                $insertData = [
                    'firstname' => $this->request->getVar('f_name'),
                    'lastname'=>$this->request->getVar('l_name'),
                    'city'=>$this->request->getVar('city'),
                    'area'=> $this->request->getVar('area'),
                    'pincode'=> $this->request->getVar('pincode'),
                    'message'=> $this->request->getVar('message'),
                    'fkuser_id' => session()->get('id'),
                ];

                if($model->insert($insertData)){
                  
                $insertId = $model->getInsertID();
                $jsonData = array('status'=>'success','lastInsertId'=> $insertId);
               
               

                }

                else{

                    $jsonData = array('status'=>'failed');
                   
                }
               
                 echo json_encode($jsonData);
    }
    // return view('checkout',$data);
}


public function proceedToOrder()
{
   $data = [];
   $cartModel = new CartModel();
   $orderItems = new OrderItemModel();
   if($this->request->getMethod() == 'post'){

    $insertData = [
        'firstname' => $this->request->getVar('f_name'),
        'lastname'=>$this->request->getVar('l_name'),
        'city'=>$this->request->getVar('city'),
        'area'=> $this->request->getVar('area'),
        'pincode'=> $this->request->getVar('pincode'),
        'message'=> $this->request->getVar('message'),
        'fkuser_id' => session()->get('id'),
    ];
   }
}

}
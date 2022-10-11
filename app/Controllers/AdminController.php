<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
// use App\Models\AdminModel;
use App\Models\CategoryModel;

 \Config\Services::validation();

class AdminController extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('admin/login');
    }

    public function signin()
    {
        helper(['form']);
        $session = session();
        $userModel = new AdminModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if(!$authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('admin/dashboard');
            
            }
            else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('admin');
            }

        }
        else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('admin');
        }


        }

    public function dashboard()
    {
        $data = [];
        $data['admin_content'] = 'admin/dashboard';
        return view('admin/includes/template',$data);
    }

    public function logout()
    {
        session()->session_destroy();
      
        redirect()->to(base_url('/admin'));

    }



  

    public function category()
    {

        $data = [];
        $model = new CategoryModel();
        if($this->request->getMethod() == 'post'){

            $tableData = [
                'cat_name' => $this->request->getVar('category'),
            ];
            
            if($model->save($tableData)){
                $data['cat_data'] = true;
            }

        }
       
        $data['admin_content'] = 'admin/category';
        return view('admin/includes/template',$data);

    }
}

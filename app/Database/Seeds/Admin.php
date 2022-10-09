<?php

namespace App\Database\Seeds;

use App\Models\AdminModel;
use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        $user_object = new AdminModel();
        $user_object->insertBatch([[

                "name"=>"Mahmodul Karim",
                "email"=>"m.karimcu@gmail.com",
                "phone_no"=>"01720626250",
                "role"=>"admin",
                "password"=>password_hash("mmk12345", PASSWORD_DEFAULT)

        ],

        [
                "name"=>"hasanuzzaman",
                "email"=>"hasan@gmail.com",
                "phone_no"=>"01711452114",
                "role"=>"editor",
                "password"=>password_hash("12345678", PASSWORD_DEFAULT)


        ]
    ]);
    }

}

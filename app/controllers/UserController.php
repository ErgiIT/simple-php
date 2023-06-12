<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Model;
use App\Models\User;
use Exception;

class UserController
{
    public function index()
    {
       return User::get();
    }

    public function upsert($id = null){
        $data = [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'phone' => $_REQUEST['phone'],
            'weight' => $_REQUEST['weight']
        ];

        $user = new User();

        foreach ($data as $key => $value){
            $user->$key = $value;
        }
       
        if (isset($id)){
            User::update($id, $data);
        } else {
           User::create($data);
        }

        return $user;
    }

    public function delete($id)
    {
       try{
            User::delete($id);
       }catch(Exception $e){
            $e->getMessage();
       }

    }
}





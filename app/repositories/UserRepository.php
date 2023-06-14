<?php

namespace App\Repositories;

use App\Models\User;
use App\Requests\UserUpsert;

class UserRepository
{
    public static function get()
    {
       return User::get();
    }

    public static function upsert($id = null){

        UserUpsert::upsertValidation();

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

    public static function delete($id)
    {     
        User::delete($id);
    }
}
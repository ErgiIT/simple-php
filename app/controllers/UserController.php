<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use Exception;

class UserController
{
    public function index()
    {
        try{
            return UserRepository::get();
        }catch(Exception $e){
            $e->getMessage();
        }
    }

    public function upsert($id = null){
        try{
            return UserRepository::upsert($id);
        }catch(Exception $e){
            $e->getMessage();
        }
    }

    public function delete($id)
    {
       try{
            return UserRepository::delete($id);
       }catch(Exception $e){
            $e->getMessage();
       }

    }
}





<?php

namespace App\Controllers;

use App\Repositories\ClothesRepository;
use Exception;

class ClothController
{
    public function index()
    {
        try{
            return ClothesRepository::get();
        }catch(Exception $e){
            $e->getMessage();
        }
        
    }
    
    public function upsert($id = null){
        try{
            return ClothesRepository::upsert($id);
        }catch(Exception $e){
            $e->getMessage();
        }
    }

    public function delete($id)
    {
        try{
            return ClothesRepository::delete($id);
        }catch(Exception $e){
            $e->getMessage();
        }
    }

    public function findByType($type)
    {
        try{
            return ClothesRepository::find($type);
        }catch(Exception $e){
            $e->getMessage();
        }
        
    }

}

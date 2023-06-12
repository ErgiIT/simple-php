<?php

namespace App\Controllers;

use App\Models\Cloth;
use Exception;

class ClothController
{
    public function index()
    {
       return Cloth::get();
    }
    
    public function upsert($id = null){
        $data = [
            'title' => $_REQUEST['title'],
            'description' => $_REQUEST['description'],
            'size' => $_REQUEST['size'],
            'price' => $_REQUEST['price'],
            'quantity' => $_REQUEST['quantity'],
            'currency' => $_REQUEST['currency'],
            'type' => $_REQUEST['type']
        ];

        $user = new Cloth();

        foreach ($data as $key => $value){
            $user->$key = $value;
        }
       
        if (isset($id)){
            Cloth::update($id, $data);
        } else {
            Cloth::create($data);
        }

        return $user;
    }

    public function delete($id)
    {
        try{
            Cloth::delete($id);
       }catch(Exception $e){
            $e->getMessage();
       }
    }
}

<?php

namespace App\Repositories;

use App\Models\Cloth;
use App\Requests\ClothUpsert;

class ClothesRepository
{
    public static function get()
    {
       return Cloth::get();
    }
    
    public static function upsert($id = null){

        ClothUpsert::upsertValidation();

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

    public static function delete($id)
    {
            Cloth::delete($id);
    }

    public static function find($type)
    {
        return Cloth::where('type', $type);
    }
}
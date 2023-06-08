<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Cloth;

class ClothController
{
    public function index()
    {
        $clothes = App::get('database')->selectAll('clothes');

        return $clothes;
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
            App::get('database')->update('clothes', $id, $data);
        } else {
            App::get('database')->insert('clothes', $data);
        }

        return $user;
    }

    public function delete($id)
    {
        // Delete the cloth from the database
        App::get('database')->delete('clothes', $id);

        return ['message' => 'Cloth deleted successfully'];
    }
}

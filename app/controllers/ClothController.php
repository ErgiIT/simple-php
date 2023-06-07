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

    public function store()
    {
        $cloth = new Cloth();
        $cloth->title = $_POST['title'];
        $cloth->description = $_POST['description'];
        $cloth->size = $_POST['size'];
        $cloth->price = $_POST['price'];
        $cloth->quantity = $_POST['quantity'];
        $cloth->currency = $_POST['currency'];
        $cloth->type = $_POST['type'];

        // Save the cloth to the database
        App::get('database')->insert('clothes', [
            'title' => $cloth->title,
            'description' => $cloth->description,
            'size' => $cloth->size,
            'price' => $cloth->price,
            'quantity' => $cloth->quantity,
            'currency' => $cloth->currency,
            'type' => $cloth->type
        ]);

        return $cloth;
    }

    public function update($id)
    {
        $cloth = new Cloth();
        $cloth->title = $_POST['title'] ?? "";
        $cloth->description = $_POST['description'] ?? "";
        $cloth->size = $_POST['size'] ?? "";
        $cloth->price = $_POST['price'] ?? "";
        $cloth->quantity = $_POST['quantity'] ?? "";
        $cloth->currency = $_POST['currency'] ?? "";
        $cloth->type = $_POST['type'] ?? "";

        // Update the cloth in the database
        App::get('database')->update('clothes', $id, [
            'title' => $cloth->title,
            'description' => $cloth->description,
            'size' => $cloth->size,
            'price' => $cloth->price,
            'quantity' => $cloth->quantity,
            'currency' => $cloth->currency,
            'type' => $cloth->type,
        ]);

        return $cloth;
    }

    public function delete($id)
    {
        // Delete the cloth from the database
        App::get('database')->delete('clothes', $id);

        return ['message' => 'Cloth deleted successfully'];
    }
}

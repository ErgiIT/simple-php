<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\ClothUser;

class PurchaseController
{
    public function buy()
    {
        $userId = $_POST['user_id'];
        $clothId = $_POST['cloth_id'];
        $quantity = $_POST['quantity'];

        // Retrieve the cloth from the database
        $cloth = App::get('database')->selectById('clothes', $clothId);

        if ($cloth) {
            // Check if the requested quantity is available
            if ($cloth->quantity >= $quantity) {
                // Create a new ClothUser record
                $clothUser = new ClothUser();
                $clothUser->user_id = $userId;
                $clothUser->cloth_id = $clothId;
                $clothUser->quantity = $quantity;

                // Save the ClothUser record to the database
                App::get('database')->insert('cloth_user', [
                    'user_id' => $clothUser->user_id,
                    'cloth_id' => $clothUser->cloth_id,
                    'quantity' => $clothUser->quantity
                ]);

                // Update the quantity of the cloth in the clothes table
                $newQuantity = $cloth->quantity - $quantity;
                App::get('database')->update('clothes', $clothId, ['quantity' => $newQuantity]);

                // Retrieve all the clothes owned by the user
                $userClothes = App::get('database')->select('cloth_user', ['user_id' => $userId]);

                return $userClothes;
            } else {
                return ['message' => 'Insufficient quantity available.'];
            }
        } else {
            return ['message' => 'Cloth not found.'];
        }
    }

    public function getUserClothes()
    {
        $userId = $_POST['user_id'];

        // Retrieve all the clothes owned by the user
        $userClothes = App::get('database')->select('cloth_user', ['user_id' => $userId]);

        return $userClothes;
    }
}

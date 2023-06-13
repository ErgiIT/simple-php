<?php

namespace App\Repositories;

use App\Models\Cloth;
use App\Models\ClothUser;

class PurchaseRepository
{
    public static function get()
    {
        return ClothUser::get();
    }

    public static function buy()
    {
        $userId = $_POST['user_id'];
        $clothId = $_POST['cloth_id'];
        $quantity = $_POST['quantity'];

        // Retrieve the cloth from the database
        $cloth = Cloth::find($clothId);

        if ($cloth) {
            // Check if the requested quantity is available
            if ($cloth->quantity >= $quantity) {
                $data = [
                    'user_id' => $userId,
                    'cloth_id' => $clothId,
                    'quantity' => $quantity
                ];

                ClothUser::create($data);

                $newQuantity = $cloth->quantity - $quantity;
                Cloth::update($clothId, ['quantity' => $newQuantity]);

                return $data;

            } else {
                return ['message' => 'Insufficient quantity available.'];
            }
        } else {
            return ['message' => 'Cloth not found.'];
        }
    }

    public static function delete($id)
    {
        ClothUser::delete($id);
        return "Record deleted";
    }

    public static function select($id)
    {
        return ClothUser::where('user_id', $id);  
    }
}
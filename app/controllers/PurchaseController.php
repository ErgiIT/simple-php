<?php

namespace App\Controllers;

use App\Models\Cloth;
use App\Models\ClothUser;
use Exception;

class PurchaseController
{
    public function index()
    {
        return ClothUser::get();
    }

    public function buy()
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

            } else {
                return ['message' => 'Insufficient quantity available.'];
            }
        } else {
            return ['message' => 'Cloth not found.'];
        }
    }

    public function delete($id)
    {
        ClothUser::delete($id);
        echo "Record deleted";
    }

    public function select($id)
    {
        try {
            return ClothUser::find(['user_id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

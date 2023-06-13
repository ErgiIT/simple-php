<?php

namespace App\Controllers;

use App\Repositories\PurchaseRepository;
use Exception;

class PurchaseController
{
    public function index()
    {
       try {
            return PurchaseRepository::get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function buy()
    {
        try {
            return PurchaseRepository::buy();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            return PurchaseRepository::delete($id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function select($id)
    {
        try {
            return PurchaseRepository::select($id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

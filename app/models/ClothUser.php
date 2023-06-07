<?php

namespace App\Models;

use Exception;

class ClothUser
{
    public $user_id;
    public $cloth_id;
    public $quantity;

    public function __get($var)
    {
        throw new Exception("Invalid property $var");
    }
}

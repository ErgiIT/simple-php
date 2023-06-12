<?php

namespace App\Models;

use Exception;

class ClothUser extends Model
{
    public $user_id;
    public $cloth_id;
    public $quantity;
    protected const TABLE = "cloth_user"; 

    protected static function getTable() {
        return self::TABLE;
    }

    public function __get($var)
    {
        throw new Exception("Invalid property $var");
    }
}

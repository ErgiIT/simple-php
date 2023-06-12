<?php

namespace App\Models;

use Exception;

class Cloth extends Model
{
    public $title;
    public $description;
    public $size;
    public $price;
    public $quantity;
    public $currency;
    public $type;
    protected const TABLE = "clothes"; 

    protected static function getTable() {
        return self::TABLE;
    }

    public function __get($var)
    {
        throw new Exception("Invalid property $var");
    }

}

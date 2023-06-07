<?php

namespace App\Models;

use Exception;

class Cloth
{
    public $title;
    public $description;
    public $size;
    public $price;
    public $quantity;
    public $currency;
    public $type;

    public function __get($var)
    {
        throw new Exception("Invalid property $var");
    }

}

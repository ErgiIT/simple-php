<?php

namespace App\Models;

use Exception;

class User
{
    public $name;
    public $email;
    public $phone;
    public $weight;

    public function __get($var)
    {
        throw new Exception("Invalid property $var");
    }
}

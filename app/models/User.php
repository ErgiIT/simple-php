<?php

namespace App\Models;

use Exception;

class User extends Model
{
    public $name;
    public $email;
    public $phone;
    public $weight;
    protected const TABLE = "users"; 

    protected static function getTable() {
        return self::TABLE;
    }

    public function __get($var)
    {
        throw new Exception("Invalid property $var");
    }
}

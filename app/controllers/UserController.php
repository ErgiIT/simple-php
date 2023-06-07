<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

class UserController
{
    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return $users;
    }

    /**
     * Store a new user in the database.
     */
    public function store()
    {
        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->weight = $_POST['weight'];

        // Save the user to the database
        App::get('database')->insert('users', [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'weight' => $user->weight,
        ]);

        return $user;
    }
}




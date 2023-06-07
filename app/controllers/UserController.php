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
    /**
     * Update a user in the database.
     *
     * @param int $id
     */
    public function update($id)
    {
        $user = new User();
        $user->name = $_POST['name'] ?? '';
        $user->email = $_POST['email'] ?? '';
        $user->phone = $_POST['phone'] ?? '';
        $user->weight = $_POST['weight'] ?? '';

         // Update the user in the database
        App::get('database')->update('users', $id, [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'weight' => $user->weight,
        ]);

        return $user;
    }

    /**
     * Delete a user from the database.
     *
     * @param int $id
     */
    public function delete($id)
    {
        // Delete the user from the database
        App::get('database')->delete('users', $id);

        return 'User deleted successfully';
    }
}





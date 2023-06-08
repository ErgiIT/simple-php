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

    public function upsert($id = null){
        $data = [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'phone' => $_REQUEST['phone'],
            'weight' => $_REQUEST['weight']
        ];

        $user = new User();

        foreach ($data as $key => $value){
            $user->$key = $value;
        }
       
        if (isset($id)){
            App::get('database')->update('users', $id, $data);
        } else {
            App::get('database')->insert('users', $data);
        }

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





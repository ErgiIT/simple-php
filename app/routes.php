<?php

// $router->get('', 'PagesController@home');
// $router->get('about', 'PagesController@about');
// $router->get('contact', 'PagesController@contact');

$router->get('users', 'UserController@index');
$router->post('users', 'UserController@store');
// $router->put('users/{id}', 'UserController@update');
// $router->delete('users/{id}', 'UserController@delete');





// // Import the necessary classes
// use App\Controllers\UserController;

// // Define your routes
// $router->get('users', [UserController::class, 'index']);
// $router->post('users', [UserController::class, 'store']);
// $router->put('users/{id}', [UserController::class, 'update']);
// $router->delete('users/{id}', [UserController::class, 'delete']);

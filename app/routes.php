<?php



$router->get('users', 'UserController@index');
$router->post('users', 'UserController@store');
$router->post('users/{id}/update', 'UserController@update');
$router->post('users/{id}/delete', 'UserController@delete');


$router->get('clothes', 'ClothController@index');
$router->post('clothes', 'ClothController@store');
$router->post('clothes/{id}/update', 'ClothController@update');
$router->post('clothes/{id}/delete', 'ClothController@delete');

$router->post('buy', 'PurchaseController@buy');
$router->post('user-clothes', 'PurchaseController@getUserClothes');
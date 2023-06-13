<?php

$router->get('users', 'UserController@index');
$router->post('users', 'UserController@upsert');
$router->post('users/{id}', 'UserController@upsert');
$router->post('users/{id}/delete', 'UserController@delete');


$router->get('clothes', 'ClothController@index');
$router->post('clothes', 'ClothController@upsert');
$router->post('clothes/{id}', 'ClothController@upsert');
$router->post('clothes/{id}/delete', 'ClothController@delete');
$router->get('clothes/{type}', 'ClothController@findByType');



$router->get('buy', 'PurchaseController@index');
$router->post('buy', 'PurchaseController@buy');
$router->post('buy/{id}/delete', 'PurchaseController@delete');
$router->get('buy/{id}', 'PurchaseController@select');

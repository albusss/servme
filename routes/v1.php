<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('login/', 'UsersController@login');
$router->post('register/', 'UsersController@register');
$router->get('logout/', 'UsersController@logout');

$router->group(['prefix' => 'api/v1/', 'middleware' => 'auth'], static function ($router) {

    $router->post('todos/', 'TodoController@create');
    $router->get('todos/', 'TodoController@list');
    $router->get('todos/{id}/', 'TodoController@show');
    $router->patch('todos/{id}/', 'TodoController@update');
    $router->delete('todos/{id}/', 'TodoController@delete');

    $router->post('categories/', 'CategoryController@create');
    $router->get('categories/', 'CategoryController@list');
    $router->get('categories/{id}/', 'CategoryController@show');
    $router->patch('categories/{id}/', 'CategoryController@update');
    $router->delete('categories/{id}/', 'CategoryController@delete');
});

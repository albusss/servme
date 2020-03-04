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

$router->get('login/', 'UsersController@login');
$router->get('logout/', 'UsersController@logout');
$router->get('register/', 'UsersController@register');

//$router->group(['prefix' => 'api/v1/', 'middleware' => 'auth'], static function ($router) {
//    $router->post('todos/', 'TodoController@create');
//    $router->get('todos/', 'TodoController@list');
//    $router->get('todos/{id}/', 'TodoController@show');
//    $router->patch('todos/{id}/', 'TodoController@update');
//    $router->delete('todos/{id}/', 'TodoController@delete');
//});

$router->group(['prefix' => 'api/v1/'], static function ($router) {
    $router->post('todos/', 'TodoController@create');
    $router->get('todos/', 'TodoController@list');
    $router->get('todos/{id}/', 'TodoController@show');
    $router->patch('todos/{id}/', 'TodoController@update');
    $router->delete('todos/{id}/', 'TodoController@delete');
});

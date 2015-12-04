<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
$router->get('document', ['as' => 'document', 'uses' => 'HomeController@document']);
$router->get('sign-in', ['as' => 'sign-in', 'uses' => 'HomeController@signIn', 'middleware' => 'auth.basic']);

$router->group(['prefix' => 'zinc', 'namespace' => 'Zinc'], function (Router $router) {
    $router->group(['middleware' => 'auth.basic'], function (Router $router) {
        $router->resource('manage', 'ManageController', ['except' => ['show']]);
    });

    $router->get('/', ['as' => 'zinc.index', 'uses' => 'ZincController@index']);
    $router->get('{year}/{month}', ['as' => 'zinc.show', 'uses' => 'ZincController@show']);
});

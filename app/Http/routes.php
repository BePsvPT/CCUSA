<?php

/** @var Router $router */

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

$router->group(['middleware' => ['web']], function (Router $router) {
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
});

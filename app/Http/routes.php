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

/** @var \Illuminate\Routing\Router $router */

$router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);

$router->get('zinc', ['as' => 'zinc', 'uses' => 'HomeController@zinc']);

$router->get('document', ['as' => 'document', 'uses' => 'HomeController@document']);

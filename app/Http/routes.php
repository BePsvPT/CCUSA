<?php

/** @var Router $router */
use Illuminate\Routing\Router;

$router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);

$router->get('zine/manage', ['as' => 'zinc.manage', 'uses' => 'ZincController@manage']);
$router->resource('zine', 'ZincController', ['names' => 'zinc', 'except' => ['show']]);
$router->get('zine/{year}/{month}', ['as' => 'zinc.show', 'uses' => 'ZincController@show']);
// 重新導向會刊網址
$router->get('zinc/{redirect?}', 'ZincController@redirect')->where('redirect', '.*');

$router->resource('documents', 'DocumentController', ['parameters' => ['documents' => 'hashid']]);

$router->get('cooperative-stores/manage', ['as' => 'cooperative-stores.manage', 'uses' => 'CooperativeStoreController@manage']);
$router->resource('cooperative-stores', 'CooperativeStoreController', ['parameters' => ['cooperative-stores' => 'cs']]);

$router->get('cooperative-stores/profile', ['as' => 'cooperative-stores.profile', 'uses' => 'CooperativeStoreController@profile']);

$router->group(['prefix' => 'auth', 'as' => 'auth.'], function (Router $router) {
    $router->get('sign-in', ['as' => 'sign-in', 'uses' => 'AuthController@signIn']);
    $router->post('sign-in', ['as' => 'sign-in', 'uses' => 'AuthController@auth']);
    $router->get('sign-out', ['as' => 'sign-out', 'uses' => 'AuthController@signOut']);
});

$router->get('profile', 'ProfileController@index');
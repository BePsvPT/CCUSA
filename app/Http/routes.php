<?php

/** @var Router $router */
use Illuminate\Routing\Router;

$router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);

$router->group(['prefix' => 'zinc', 'namespace' => 'Zinc', 'as' => 'zinc.'], function (Router $router) {
    $router->group(['middleware' => ['role:zinc']], function (Router $router) {
        $router->get('manage/analytics', ['as' => 'manage.analytics', 'uses' => 'ManageController@analytics']);
        $router->get('manage/analytics/data', ['as' => 'manage.analytics.data', 'uses' => 'ManageController@analyticsData']);
        $router->resource('manage', 'ManageController', ['except' => ['show']]);
    });

    $router->get('/', ['as' => 'index', 'uses' => 'ZincController@index']);
    $router->get('{year}/{month}', ['as' => 'show', 'uses' => 'ZincController@show']);
});

$router->resource('documents', 'DocumentController', ['parameters' => ['documents' => 'hashid']]);
$router->resource('cooperative-stores', 'CooperativeStoreController', ['parameters' => ['cooperative-stores' => 'cs']]);

$router->group(['prefix' => 'auth', 'as' => 'auth.'], function (Router $router) {
    $router->get('sign-in', ['as' => 'sign-in', 'uses' => 'AuthController@signIn']);
    $router->post('sign-in', ['as' => 'sign-in', 'uses' => 'AuthController@auth']);
    $router->get('sign-out', ['as' => 'sign-out', 'uses' => 'AuthController@signOut']);
});

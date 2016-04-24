<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->group(['middleware' => ['web']], function (Router $router) {
    $router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
    $router->get('document', ['as' => 'document', 'uses' => 'HomeController@document']);

    $router->group(['prefix' => 'zinc', 'namespace' => 'Zinc'], function (Router $router) {
        $router->group(['middleware' => 'auth'], function (Router $router) {
            $router->get('manage/analytics', ['as' => 'zinc.manage.analytics', 'uses' => 'ManageController@analytics']);
            $router->get('manage/analytics/data', ['uses' => 'ManageController@analyticsData']);
            $router->resource('manage', 'ManageController', ['except' => ['show']]);
        });

        $router->get('/', ['as' => 'zinc.index', 'uses' => 'ZincController@index']);
        $router->get('{year}/{month}', ['as' => 'zinc.show', 'uses' => 'ZincController@show']);
    });
    
    $router->group(['prefix' => 'auth', 'as' => 'auth.'], function (Router $router) {
        $router->get('sign-in', ['as' => 'sign-in', 'uses' => 'AuthController@signIn']);
        $router->post('sign-in', ['as' => 'sign-in', 'uses' => 'AuthController@auth']);
        $router->get('sign-out', ['as' => 'sign-out', 'uses' => 'AuthController@signOut']);
    });
});

<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->group(['middleware' => ['web']], function (Router $router) {
    $router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
    $router->get('document', ['as' => 'document', 'uses' => 'HomeController@document']);
    $router->get('sign-in', ['as' => 'sign-in', 'uses' => 'HomeController@signIn', 'middleware' => 'auth.basic']);

    $router->group(['prefix' => 'zinc', 'namespace' => 'Zinc'], function (Router $router) {
        $router->group(['middleware' => 'auth.basic'], function (Router $router) {
            $router->get('manage/analytics', ['as' => 'zinc.manage.analytics', 'uses' => 'ManageController@analytics']);
            $router->get('manage/analytics/data', ['uses' => 'ManageController@analyticsData']);
            $router->resource('manage', 'ManageController', ['except' => ['show']]);
        });

        $router->get('/', ['as' => 'zinc.index', 'uses' => 'ZincController@index']);
        $router->get('{year}/{month}', ['as' => 'zinc.show', 'uses' => 'ZincController@show']);
    });
});

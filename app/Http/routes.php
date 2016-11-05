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

$app->get('/', ['uses' => 'AppController@helloWorld']);

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'products'], function ($api) {
    $api->get('/', ['uses' => 'AppController@getProduct']);
    $api->post('/', ['uses' => 'AppController@createProduct']);
});

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'sellers'], function ($api) {
    $api->get('/', ['uses' => 'AppController@getSeller']);
    $api->post('/', ['uses' => 'AppController@createSeller']);
});

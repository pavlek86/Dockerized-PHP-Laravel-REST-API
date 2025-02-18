<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'shopping-list'
], function ($router) {
    Route::post('', 'ShoppingListController@create');
    Route::get('/{id}', 'ShoppingListController@read');
    Route::put('/{id}', 'ShoppingListController@update');
    Route::delete('/{id}', 'ShoppingListController@delete');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'report'
], function ($router) {
    Route::get('', 'ReportController@index');
});

<?php

use Illuminate\Http\Request;
use Laravel\Passport\Passport;

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

Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'RegisterController@register');
});

Route::group(['prefix' => 'events'], function () {
    Route::get('upcoming', 'EventsController@upcoming');
});

<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
    Route::resource('products', 'ProductController');
    Route::post('dial-activities', 'DialActivityController@store');
    Route::get('dial-activities/client/{id}', 'DialActivityController@showByClientID');
    Route::get('dial-activities/grocery-store/{id}', 'DialActivityController@showByStoreID');
    Route::get('dial-activities/garbage-dumpster/{id}', 'DialActivityController@showByDumpsterID');
});



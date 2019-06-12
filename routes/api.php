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

Route::middleware('auth:api')->get('/slots', function (Request $request) {
    return $request->slot();
});

Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['slot'=>'API\SlotController']);
Route::get('profile','API\UserController@profile');
Route::get('findUser','API\UserController@search');
Route::get('findSlot','API\SlotController@search');

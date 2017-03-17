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
Route::group(['middleware' => ['web', 'auth']], function()
{
    Route::get('/test', 'UserController@get_user_from_token');
    Route::post('/login', 'UserController@get_token_from_login');
});

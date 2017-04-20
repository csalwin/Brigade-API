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

Route::post('/login', 'UserController@get_token_from_login');
Route::group(['middleware' => ['web', 'auth']], function()
{
    Route::get('/user', 'UserController@get_user_from_token');

    Route::post('/lead/save', 'LeadController@api_save');
    Route::get('/lead/list', 'LeadController@api_list');
    Route::post('/lead/listusr', 'LeadController@api_userList');
    Route::post('/lead/update', 'LeadController@api_edit');
});

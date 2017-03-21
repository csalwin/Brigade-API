<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/users/manage', 'UserController@list_users')->middleware('auth');
Route::get('/users/create', 'UserController@create')->middleware('auth');
Route::post('/users/create', 'UserController@save')->middleware('auth');
Route::get('/users/edit/{id}', 'UserController@edit')->middleware('auth');
Route::post('/users/edit/{id}', 'UserController@save')->middleware('auth');
Route::get('/users/delete/{id}', 'UserController@delete')->middleware('auth');

Route::get('/leads/view', 'LeadController@index')->middleware('auth');
Route::get('/leads/export', 'LeadController@export')->middleware('auth');


Route::get('/', 'HomeController@index');

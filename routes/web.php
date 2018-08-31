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

Route::get('/', 'TasksController@welcome');

Route::get('/tasks', 'TasksController@index');

Route::post('/create-task', 'TasksController@store');

Route::post('/update-task', 'TasksController@update');

Route::get('/delete-task/{id}', 'TasksController@delete');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

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

Route::get('/', 'IndexController@index');

Route::get('index/editUser/{action}', 'IndexController@edit');

Route::get('index/editCategory/{action}', 'IndexController@edit');

Route::get('index/editPost/{action}', 'IndexController@edit');

Route::post('index/edit', 'IndexController@edit');

Route::post('index/user', 'IndexController@user');

Route::post('index/category', 'IndexController@category');

Route::post('index/post', 'IndexController@post');

Route::post('index/find-campo-x', 'IndexController@findCampoX');

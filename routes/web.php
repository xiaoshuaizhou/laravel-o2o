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

Route::get('/', 'Index\IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//主管理员后台
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.admin.index');
    });
});



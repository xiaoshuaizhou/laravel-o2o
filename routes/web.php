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
Route::get('index/welcome', 'Index\IndexController@welcome');
//主管理员后台
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.admin.index');
    });

    Route::get('test', 'Admin\CategoryController@test');
    Route::get('/category', 'Admin\CategoryController@index');
    Route::get('/category/add', 'Admin\CategoryController@add');
    Route::get('/category/{id}', 'Admin\CategoryController@getSonsCategorys');
    Route::post('/category/add', 'Admin\CategoryController@store');
    Route::get('/status/index/{id}/{status}', 'Admin\StatusController@index');
    Route::get('category/edit/{id}','Admin\CategoryController@edit');
    Route::post('category/edit/','Admin\CategoryController@update');
    Route::post('category/listorder', 'Admin\CategoryController@listorder');
    Route::get('category/del/{id}', 'Admin\CategoryController@delete');
    //城市管理
    Route::get('city','Admin\CitysController@index');
    Route::get('city/add','Admin\CitysController@add');
    Route::post('city/add','Admin\CitysController@store');
    Route::get('city/{id}', 'Admin\CitysController@getSonsCitys');
    Route::get('city/edit/{id}', 'Admin\CitysController@edit');
    Route::post('city/edit/', 'Admin\CitysController@update');
    Route::post('city/listorder', 'Admin\CitysController@listorder');

    Route::get('city/del/{id}', 'Admin\CitysController@delete');
    Route::get('status/citystatus/{id}/{status}', 'Admin\StatusController@city');
});

//商户后台

Route::group(['prefix' => 'bis'], function (){
    Route::get('/', 'Bis\IndexController@index');
    Route::get('login', 'Bis\LoginController@index');
    Route::get('register', 'Bis\RegisterController@index');
    Route::post('register/add', 'Bis\RegisterController@store');
    Route::post('/api/upload', 'Bis\ApiController@upload');

    Route::post('/api/getCityByParentId', 'Bis\ApiController@getCityByParentId');
    Route::post('/api/getCategoryByParentId', 'Bis\ApiController@getCategoryByParentId');
    Route::post('/api/upload', 'Bis\ApiController@upload');
    Route::get('register/waiting/{id}', 'Bis\RegisterController@waiting');
});

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
Route::get('index/index/{city}', 'Index\IndexController@index');
Route::get('index/detail/{id}/{city_id}/{cat_id}', 'Index\DetailController@index');
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
    Route::get('/bis/apply', 'Admin\BisController@apply');
    Route::get('status/bisstatus/{id}/{status}', 'Admin\StatusController@bis');
    Route::get('/bis/index', 'Admin\BisController@index');
    Route::get('/bis/del', 'Admin\BisController@destory');
    Route::get('bis/detail/{id}', 'Admin\BisController@detail');
    Route::get('bis/destory/{id}/{status}', 'Admin\StatusController@destory');
    Route::get('/deal/index', 'Admin\DealsController@index');
    Route::post('/deal/index', 'Admin\DealsController@index');
    Route::get('/deal/review', 'Admin\DealsController@review');
    Route::post('/deal/review', 'Admin\DealsController@review');
    Route::get('/status/dealIndex/{id}/{status}', 'Admin\StatusController@dealIndex');
    Route::get('deal/edit/{id}', 'Admin\DealsController@edit');
    Route::post('deal/edit/', 'Admin\DealsController@update');
    Route::get('deal/del/{id}', 'Admin\DealsController@destory');
    Route::get('featured/add', 'Admin\FeaturedController@add');
    Route::get('featured/index', 'Admin\FeaturedController@index');
    Route::post('featured/create', 'Admin\FeaturedController@create');
    Route::get('featured/status/{id}/{status}', 'Admin\StatusController@featuredstatus');
    Route::get('featured/del/{del}', 'Admin\FeaturedController@destory');
});

//商户后台

Route::group(['prefix' => 'bis'], function (){
    Route::get('/', 'Bis\IndexController@index');
    Route::get('login', 'Bis\LoginController@index');
    Route::post('login', 'Bis\LoginController@login');
    Route::get('register', 'Bis\RegisterController@index');
    Route::post('register/add', 'Bis\RegisterController@store');
    Route::post('/api/upload', 'Bis\ApiController@upload');

    Route::post('/api/getCityByParentId', 'Bis\ApiController@getCityByParentId');
    Route::post('/api/getCategoryByParentId', 'Bis\ApiController@getCategoryByParentId');
    Route::post('/api/upload', 'Bis\ApiController@upload');
    Route::get('register/waiting/{id}', 'Bis\RegisterController@waiting');
    Route::any('logout', 'Bis\LoginController@logout');
    Route::get('/location/create', 'Bis\LocaltionController@create');
    Route::post('/location/create', 'Bis\LocaltionController@store');
    Route::get('/location/', 'Bis\LocaltionController@index');
    Route::get('/location/edit/{id}', 'Bis\LocaltionController@edit');
    Route::get('/locations/del/{id}', 'Bis\LocaltionController@destory');
    Route::get('/deal/', 'Bis\DealController@index');
    Route::get('/deal/create', 'Bis\DealController@create');
    Route::post('/deal/create', 'Bis\DealController@add');
});

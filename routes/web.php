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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('weixinpay/index',function (){
    return view('index');
});
//前台模块
Route::namespace('Index')->group(function (){
    Route::get('/', 'IndexController@index');
    Route::get('index/welcome', 'IndexController@welcome');
    Route::get('index/index/{city}', 'IndexController@index');
    Route::get('index/detail/{id}/{city_id}/{cat_id}', 'DetailController@index');
    Route::get('index/map/{data}', 'MapController@getMapImage');
    Route::get('index/list/{id}/{order?}', 'ListsController@index');
    Route::get('index/order/{id}/{count}', 'OrderController@confirm');
    Route::get('index/order/{id}/{count}/{price}', 'OrderController@index');
    Route::get('index/pay/{id}', 'PayController@index');
    Route::any('weixinpay/notify', 'WechatController@notify');
    Route::any('weixinpay/payqrcode/{id}', 'WechatController@payQrcode');
    Route::post('index/orders/paystatus', 'OrderController@paystatus');
    Route::get('index/pays/paysuccess', 'PayController@paysuccess');
});
//主管理员后台
Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function (){
    Route::get('/', function () {
        return view('admin.admin.index');
    });
    Route::get('test', 'CategoryController@test');
    Route::get('/category', 'CategoryController@index');
    Route::get('/category/add', 'CategoryController@add');
    Route::get('/category/{id}', 'CategoryController@getSonsCategorys');
    Route::post('/category/add', 'CategoryController@store');
    Route::get('/status/index/{id}/{status}', 'StatusController@index');
    Route::get('category/edit/{id}','CategoryController@edit');
    Route::post('category/edit/','CategoryController@update');
    Route::post('category/listorder', 'CategoryController@listorder');
    Route::get('category/del/{id}', 'CategoryController@delete');
    //城市管理
    Route::get('city','CitysController@index');
    Route::get('city/add','CitysController@add');
    Route::post('city/add','CitysController@store');
    Route::get('city/{id}', 'CitysController@getSonsCitys');
    Route::get('city/edit/{id}', 'CitysController@edit');
    Route::post('city/edit/', 'CitysController@update');
    Route::post('city/listorder', 'CitysController@listorder');
    Route::get('city/del/{id}', 'CitysController@delete');
    Route::get('status/citystatus/{id}/{status}', 'StatusController@city');
    Route::get('/bis/apply', 'BisController@apply');
    Route::get('status/bisstatus/{id}/{status}', 'StatusController@bis');
    Route::get('/bis/index', 'BisController@index');
    Route::get('/bis/del', 'BisController@destory');
    Route::get('bis/detail/{id}', 'BisController@detail');
    Route::get('bis/destory/{id}/{status}', 'StatusController@destory');
    Route::get('/deal/index', 'DealsController@index');
    Route::post('/deal/index', 'DealsController@index');
    Route::get('/deal/review', 'DealsController@review');
    Route::post('/deal/review', 'DealsController@review');
    Route::get('/status/dealIndex/{id}/{status}', 'StatusController@dealIndex');
    Route::get('deal/edit/{id}', 'DealsController@edit');
    Route::post('deal/edit/', 'DealsController@update');
    Route::get('deal/del/{id}', 'DealsController@destory');
    Route::get('featured/add', 'FeaturedController@add');
    Route::get('featured/index', 'FeaturedController@index');
    Route::post('featured/create', 'FeaturedController@create');
    Route::get('featured/status/{id}/{status}', 'StatusController@featuredstatus');
    Route::get('featured/del/{del}', 'FeaturedController@destory');
});

//商户后台
Route::namespace('Bis')->prefix('bis')->group(function (){
    Route::get('/', 'IndexController@index');
    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('register', 'RegisterController@index');
    Route::post('register/add', 'RegisterController@store');
    Route::post('/api/upload', 'ApiController@upload');
    Route::post('/api/getCityByParentId', 'ApiController@getCityByParentId');
    Route::post('/api/getCategoryByParentId', 'ApiController@getCategoryByParentId');
    Route::post('/api/upload', 'ApiController@upload');
    Route::get('register/waiting/{id}', 'RegisterController@waiting');
    Route::any('logout', 'LoginController@logout');
    Route::get('/location/create', 'LocaltionController@create');
    Route::post('/location/create', 'LocaltionController@store');
    Route::get('/location/', 'LocaltionController@index');
    Route::get('/location/edit/{id}', 'LocaltionController@edit');
    Route::get('/locations/del/{id}', 'LocaltionController@destory');
    Route::get('/deal/', 'DealController@index');
    Route::get('/deal/create', 'DealController@create');
    Route::post('/deal/create', 'DealController@add');
});

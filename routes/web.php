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

// use Illuminate\Routing\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('showlogin','AdminController@showlogin');
Route::post('dologin','AdminController@dologin');
Route::get('logout','AdminController@logout');

Route::prefix('admin')->group(function (){
    //Brand
    Route::get('brand_showadd','BrandController@create');
    Route::post('brand_doadd','BrandController@store');
    Route::get('brand_list','BrandController@index');
    Route::get('brand_del/{id}','BrandController@destroy');
    Route::get('brand_edit/{id}','BrandController@edit');
    Route::post('brand_update/{id}','BrandController@update');

});

Route::prefix('text')->group(function (){
    Route::get('showadd','TextController@create');
    Route::post('doadd','TextController@store');
    Route::post('checkdoadd','TextController@checkdoadd');
    Route::get('list','TextController@index');
    Route::get('del/{id}','TextController@destroy');
    Route::get('showup/{id}','TextController@edit');
    Route::post('update/{id}','TextController@update');
});

Route::group(['prefix'=>'student'],function (){
    Route::get('showadd','StudentController@create');
    Route::post('doadd','StudentController@store');
    Route::get('list','StudentController@index');
    Route::get('del/{id}','StudentController@destroy');
    Route::get('showup/{id}','StudentController@edit');
    Route::post('update/{id}','StudentController@update');
});

Route::group(['prefix'=>'user'],function (){
    Route::get('showadd','UserController@create');
    Route::post('doadd','UserController@store');
    Route::get('list','UserController@index');
    Route::get('del/{id}','UserController@destroy');
    Route::get('update/{id}','UserController@edit');
    Route::post('doupdate/{id}','UserController@update');
});

Route::group(['prefix'=>'book'],function (){
    Route::get('showadd','BookController@create');
    Route::post('doadd','BookController@store');
    Route::get('list','BookController@index');
    Route::get('del/{id}','BookController@destroy');
});

/**
 * 分类
 */
Route::group(['prefix'=>'cate'],function (){
    Route::get('showadd','CategoryController@create');
    Route::post('doadd','CategoryController@store');
    Route::get('list','CategoryController@index');
    Route::get('del/{id}','CategoryController@destroy');
    Route::get('update/{id}','CategoryController@edit');
    Route::post('doupdate/{id}','CategoryController@update');
});

/**
 * 商品
 */
Route::prefix('goods')->group(function (){
    Route::get('showadd','GoodsController@create');
    Route::post('doadd','GoodsController@store');
    Route::get('list','GoodsController@index');
    Route::get('del/{id}','GoodsController@destroy');
    Route::get('info/{id}','GoodsController@goodsinfo');
    Route::get('cart/{id}','GoodsController@cart');
    Route::get('cartList','GoodsController@cartList');
});


















Route::get('set',function (){
    \Illuminate\Support\Facades\Cookie::queue('name','zhangsan',1);
});

Route::get('get',function (){
    echo request()->cookie('name');
});
/**
 * 发送邮件
 */
Route::get('send_email','GoodsController@send_email');








































//多请求路由
Route::match(['get','post'],'login','IndexController@login');

Route::get('create','UserInfoController@user_info');

Route::match(['get','post'],'store','UserInfoController@store');

Route::match(['get','post'],'list','UserInfoController@list');

//Route::match(['get','post'],'multy',function(){
//	return '这是match路由';
//});
//
//Route::any('multy2',function(){
//	return '这是any路由';
//});

//参数
// Route::get('user/{id}/comment/{name}',function($id , $name){
// 	return 'ID-'.$id.'<br>'.'name-'.$name;
// })->where(['id'=>'[0-9]+']); //'name'=>'[A-Za-z]' name必须是字母

//路由别名
// Route::get('user/center',['as'=>'center22',function(){
// 	return route('center22');
// }]);


//路由群组  访问方法：http://www.laravel.com/member/multy
//Route::group(['prefix'=>'member'],function(){
//	Route::match(['get','post'],'multy',function(){
//		return '这是member-match路由';
//	});
//
//	Route::get('/hello', function () {
//    	return 'member-Hello World';
//	});
//});

















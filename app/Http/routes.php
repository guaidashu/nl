<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 主页
Route::get('/', 'IndexController@index');
Route::get('index/index.html', 'IndexController@index');
	Route::get('index/getData.html', 'IndexController@getData');


// 获取数据
Route::get('data/getFoodData.html', 'DataController@getFoodData');
	Route::get('data/getFoodDataSingle.html', 'DataController@getFoodDataSingle');
	Route::get('data/getFoodDataTest.html', 'DataController@getFoodDataTest');
	Route::get('data/getFoodKindData.html', 'DataController@getFoodKindData');
	// 菜谱数据展示页面
	Route::get('data/getMenuData.html', 'DataController@getMenuDataDetail');


// 测试的页面些
Route::get('test/testReferer.html', 'TestController@testReferer');
	Route::post('test/testGetIP.html', 'TestController@testGetIP');

// 登录界面
Route::get('login/index.html', 'LoginController@index');
Route::get('login', 'LoginController@index');
Route::post('login/loginHandle.html', 'LoginController@loginHandle');
	// 退出登录
	Route::get('login/loginExit.html', 'LoginController@loginExit');
	// 注册
	Route::get('login/register.html', 'LoginController@register');
	//注册处理
	Route::post('login/registerHandle.html', 'LoginController@registerHandle');
	// 修改密码验证邮件发送
	Route::get('login/sendMail.html', 'LoginController@sendMail');

// 计算器处
Route::get('counter/counterWeight.html', 'CounterController@counterWeight');
Route::get('counter/calorie.html', 'CounterController@calorie');

// 验证码
Route::get('getValidateCount.html', 'ValidateController@getValidateCount');
Route::post('validateCheck.html', 'ValidateController@validateCheck');
Route::get('validate.html', 'ValidateController@validate');

// 公用功能处
// 获取图片(因为有的图片是加了防盗链的)
Route::get('common/getImg.html', 'CommonController@getImg');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function () {
    return view('welcome');
});

// 小米商城首页跳转
Route::any('/index', 'Admin\Index@index');
// 小米商城登录页面跳转
Route::any('/login', 'Admin\Login@dologin');
// 小米商城注册页面跳转
Route::any('/register', 'Admin\Login@register');
Route::get('/1', function () {
    echo 123;
});
// 小米商城验证码
// 注册验证码
Route::get('admin/code', 'Admin\Login@code');
// 登录验证码
Route::get('admin/code2', 'Admin\Login@code2');
Route::get('admin/getcode', 'Admin\Login@getcode');
// 小米商城练习
Route::get('admin/db', 'Admin\Index@db');



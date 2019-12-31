<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('merchant', function () {
    Route::get('login', 'merchant.User/login')
        ->validate(\app\validate\User::class, 'edit');
    Route::poster('register', 'merchant.User/register');
    Route::get('info', 'merchant.User/info');
    Route::get('wechat', 'merchant.Wechat/toAuth');
});


Route::group('wap', function () {
    Route::poster('login', 'wap.User/login')
        ->validate(\app\validate\User::class, 'edit');
    Route::poster('register', 'wap.User/register');
    Route::get('info', 'wap.User/info');
});

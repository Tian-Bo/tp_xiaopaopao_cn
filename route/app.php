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


Route::group('wap', function () {

    Route::group('user', function () {
        Route::get('login', 'wap.User/login');
        Route::get('register', 'wap.User/register');
        Route::get('info', 'wap.User/info');
    });

    Route::group('order', function () {
        Route::get('getOrder', 'wap.User/login')
            ->validate(\app\validate\User::class, 'edit');
    });

    Route::group('wechat', function () {
        Route::get('toAuth', 'wap.Wechat/toAuth');
        Route::get('auth', 'wap.Wechat/auth');
    });

})
->header('Access-Control-Allow-Origin', '*')    
->header('Access-Control-Allow-Methods', '*')
->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, x-token')
->header('Access-Control-Allow-Credentials', 'false')
->allowCrossDomain();


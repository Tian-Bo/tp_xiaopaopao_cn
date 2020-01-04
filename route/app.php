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
->allowCrossDomain([
    'Access-Control-Allow-Origin' => '*',
    'Access-Control-Allow-Methods' => '*',
    'Access-Control-Allow-Headers' => '*',
    'Access-Control-Allow-Credentials' => 'true',
]);


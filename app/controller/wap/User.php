<?php
namespace app\controller\wap;

use app\BaseController;

class User extends BaseController
{   
    /**
     * 登陆
     * 
     */
    public function login()
    {
        return 'login';
    }

    /**
     * 注册
     * 
     */
    public function register()
    {
        return 'register';
    }

    /**
     * 用户信息
     * 
     */
    public function info()
    {
        return 'info';
    }
}
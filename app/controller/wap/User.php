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
        $token = $this->request->param('x-token');
        if ($token == '') {
            return result(778, [
                'url' => '失败'
            ]);
        }

        return result(0, [
            'url' => '成功'
        ]);
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
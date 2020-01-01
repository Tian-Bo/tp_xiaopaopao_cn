<?php

namespace app\controller\wap;

use app\BaseController;

class Wechat extends BaseController
{


    /**
     * 获取微信授权需要跳转的链接
     * 
     */
    function toAuth()
    {
        $callback = input('callback', "http://wap.xiaopaopao.cn");
        $callback = urlencode($callback);

        $callback = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0c57b89185360c3b&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        
        return result(0, [
            'url' => $callback
        ]);
    }


    /**
     * 授权获取用户信息
     * 
     */

    function auth()
    {
       
    }

}


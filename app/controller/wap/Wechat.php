<?php

namespace app\controller\wap;

use app\BaseController;
use \think\facade\Config;
use app\model\UserModel;
use think\facade\Log;

class Wechat extends BaseController
{

    protected $config;

    // 初始化
    protected function initialize()
    {
        $this->config = Config::get('app');
    }


    /**
     * 定义授权链接
     * 
     */
    protected  function getAuthUrl($callback)
    {
        $callback = urlencode($callback);
        $time = time();
        $randNumber = rand(1000000, 9999999);
        $state = "{$time}{$randNumber}";
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->config['appid']}&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
    }


    /**
     * 获取微信授权需要跳转的链接
     * 
     */
    function toAuth()
    {
        $callback = input('callback', "http://wap.xiaopaopao.cn");

        return result(0, [
            'url' => $this->getAuthUrl($callback)
        ]);
    }


    /**
     * 授权获取用户信息
     * 
     */

    function auth()
    {
        # 读取code 
        $code = $this->request->param('code');
        if (!$code) {
            return result(1, 'code is mast');
        }

        # 第二步：通过code换取网页授权access_token
        $action = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->config['appid']}&secret={$this->config['appsecret']}&code={$code}&grant_type=authorization_code";
        $res = httpRequest($action);
        $res = json_decode($res, true);
        
        if (@$res['errcode'])
            return result(1, 'get access error', ['wechatResult' => $res]);

        list($access_token, $expires_in, $refresh_token, $openid, $scope) = [
            $res['access_token'],
            $res['expires_in'],
            $res['refresh_token'],
            $res['openid'],
            $res['scope'],
        ];
        
        $user = UserModel::where('openid', $openid)->find();
        if(!$user){
            //创建并返回用户
            UserModel::insert([
                'openid'=>$openid,
            ]);
            $user = UserModel::where('openid',$openid)->find();
        }
        

        # 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        $res = httpRequest($url);
        $res = json_decode($res, true);
        if (@$res['errcode']){
            Log::write("获取用户信息失败 {$openid}".json_encode($res,JSON_UNESCAPED_UNICODE),'error');
        }else{
            $saveDatas = [
                'headimgurl'=>$res['headimgurl'],
                'nickname'=>$res['nickname'],
                'sex'=>$res['sex'],
                'country'=>$res['country'],
                'city'=>$res['city'],
                'province'=>$res['province'],
            ];
            UserModel::where('id',$user['id'])->update($saveDatas);
            foreach($saveDatas as $key=>$li){
                $user[$key] = $li;
            }
        }
        # 保存登录认证令牌
        $authToken = md5($openid.microtime().rand(10000,99999));
        UserModel::where('id',$user['id'])->update([
            'auth_token'=>$authToken
        ]);
        return result(0,[
            'user'=>$user,
            'openid'=>$openid,
            'auth_token'=>$authToken
        ]);
    }
}


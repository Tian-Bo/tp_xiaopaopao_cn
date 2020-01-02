<?php


/**
 * 接口函数统一json数据返回
 * 
 * @param $errno 0表示无错误 , 1显示一个错误提示 
 * 
 * @demo result(['list'=>[]]) ,result(0,'成功') , result('错误消息');
 */
function result($errno, $msg = "success", $data = false)
{
    //多种写法兼容
    if (is_array($errno)) {
        $data = $errno;
        $errno = 0;
    } else if (is_string($errno)) {
        $msg = $errno;
        $errno = 1;
    }
    if (is_array($msg)) {
        $data = $msg;
        $msg = 'success';
    }
    //返回的数据
    $re = array(
        'errno' => $errno,
        'msg' => $msg,
        'data' => $data
    );
    //无数据的接口
    if ($data === false) {
        unset($re['data']);
    }
    return json($re, JSON_UNESCAPED_UNICODE);
}



/**
 * curl请求
 * 
 */
function httpRequest($url, $postData = null, $headers = array())
{
    $curl = curl_init();
    if (count($headers) >= 1) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //设置data , 请求方式为post 
    if (!empty($postData)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);

    return $output;
}



function toLogin(){
    
}

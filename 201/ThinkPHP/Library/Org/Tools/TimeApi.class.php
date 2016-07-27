<?php

/*
 * nowapi php语言sdk主类
 * 2014/11/12 Last Review by jason
 * --------------------------------------------------------------------------------------
 * 官网: http://www.k780.com
 * 文档: http://www.k780.com/api
 * 技术/反馈/讨论/支持: http://www.k780.com/intro/about.html
 * --------------------------------------------------------------------------------------
 * 使用方法:
 * 修改配置部分,相关值获取请登录官网 http://www.k780.com 用户中心查看，建议注册私有appkey。
 * --------------------------------------------------------------------------------------
 * 错误处理:
 * 当nowapi::callapi返回值为 false 时，可调用 nowapi::error() 查看。
 * --------------------------------------------------------------------------------------
 */
namespace Org\Tools;
class TimeApi
{
    // 配置 需修改API_APPKEY及API_SECRET，获取您自己的APPKEY及SECRET需去官网注册并免费开通相应接口
    const API_URL = 'http://api.k780.com:88';

    private static $API_APPKEY = '10003';

    private static $API_SECRET = 'd1149a30182aa2088ef645309ea193bf';
    
    // 错误容器
    private static $nowapi_error = '';
    // 加载配置，获取appkey secret
    public function __construct(){}

    /*
     * API请求主函数
     * @a_parm
     * $a_parm=array(
     * 'app'=>'接口代号',
     * 'format'=>'数据格式 json/base64',
     * 'c_timeout'=>'连接API超时时间',
     * )
     * @return 错误:false 成功:结果集数组
     */
    public function callapi($a_parm)
    {
        // 判断,调用接口方法
        if (empty($a_parm['app'])) {
            self::$nowapi_error = 'Parameter reqno nust be present';
            return false;
        }
        if (! empty($a_parm['format']) && ! in_array($a_parm['format'], array(
            'json',
            'base64',
            'xml',
            'jsonp'
        ))) {
            self::$nowapi_error = json_encode(array('msg'=>'Parameter format error','success'=>0));
            return self::$nowapi_error;
        }
        // 参数组合$a_post
        foreach ($a_parm as $key => $val) {
            $a_post[$key] = $val;
        }
        unset($a_parm);
        // 预处理
        if (empty($a_post['appkey'])) {
            $a_post['appkey'] = self::$API_APPKEY;
        }
        if (empty($a_post['secret'])) {
            $a_post['secret'] = self::$API_SECRET;
        }
        if (empty($a_post['format']) || $a_post['format']=='jsonp') {
            $a_post['format'] = 'json';
        }
        // 生成签名
        $a_post['sign'] = md5(md5($a_post['appkey']) . $a_post['secret']);
        
        $c_timeout = ! empty($a_post['c_timeout']) ? $a_post['c_timeout'] : 60;
        unset($a_post['c_timeout']);
        unset($a_post['secret']);
        
        // CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::API_URL . "/index.php");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $a_post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, $c_timeout);
        if (! $result = curl_exec($curl)) {
            self::$nowapi_error = curl_error($curl);
            curl_close($curl);
            return false;
        }
        curl_close($curl);
        return $result;
        // 结果集处理
        /* if ($a_post['format'] == 'base64') {
            $a_api = unserialize(base64_decode($result));
        }else if($a_post['format'] == 'xml'){
            if(!$a_api = json_decode(json_encode(simplexml_load_string($result)),true)){
                self::$nowapi_error = 'xml error';
                return false;
            }else {
                if($a_api['success'] == '1'){
                    return $result;
                }
            }
            
        } else {
            if (! $a_api = json_decode($result, true)) {
                self::$nowapi_error = 'remote api not json decode';
                return false;
            }
        }
        if ($a_api['success'] != '1') {
            self::$nowapi_error = $a_api['msg'];
            return false;
        }
        return $a_api; */
    }

    /* 捕捉错误 */
    public function error()
    {
        if (empty(self::$nowapi_error)) {
            return true;
        }
        return self::$nowapi_error;
    }
}
?>

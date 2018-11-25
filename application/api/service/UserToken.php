<?php
namespace app\api\service;

use think\Exception;

class UserToken
{
    protected $code ;
    protected $appId;
    protected $appSecret;
    protected $loginUrl;
    public function __construct($code)
    {
        $this->code = $code;
        $this->appId=config('wx.app_id');
        $this->appSecret=config('wx.app_secret');
        $this->loginUrl=sprintf(config('wx.url'),$this->appId,$this->appSecret,$code);
    }
    public function get()
    {
        $token = '';
        $result = curl_get($this->loginUrl);
        if(empty($result)){
            throw new Exception("微信请求无任何数据返回，请检查参数是否正常！");
        }
        $result = json_decode($result,true);
        if(array_key_exists('errorcode',$result)){
            throw new Exception("接口调用有问题！");
        }
        return $token;
    }
}
<?php
namespace app\api\service;

use app\api\model\User;
use app\lib\exception\WechatException;
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
        /**
         * openid = "oC2eH5Jd1LSc9rpulMXJhaepbVXI"
           session_key = "AaFyEIgJb2gnbCinUWJ2kw=="
         *
        */
        if(array_key_exists('errcode',$result)){
            $this->processLoginError($result);
        }else{
            $this->grantToken($result);
        }
        return $token;
    }

    private function grantToken($result)
    {
        $openid = $result['openid'];
        $user = User::where('openid','=',$openid)->find();
        if(empty($user)){
            $userAdd = User::create([
                'openid'=>$openid
            ]);
            $uid = $userAdd->id;
        }else{
            $uid = $user->id;
        }
        $cacheValue = $result;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;
        
    }
    private function processLoginError($wxResult=[])
    {
        throw new WechatException([
            'message'=>$wxResult['errmsg'],
            'error_code'=>$wxResult['errcode'],
        ]);
    }
}
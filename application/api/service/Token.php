<?php
namespace app\api\service;

use think\Exception;
use think\facade\Cache;
use think\facade\Request;

class Token
{
    public static function getTokenKey()
    {
        $key = getRandChar();
        $timestamp = $_REQUEST['REQUEST_TIME_FLOAT'];
        $salt = config('secure.saltToken');
        return md5($key.$timestamp.$salt);
    }

    public static function getKeyMessage($key='')
    {
        //todo 看下后期能不能直接Request::header('token');
        $token = Request::instance()->header('token');
        $userInfo = Cache::get($token);
        if(empty($userInfo)){
            throw new Exception('获取的Token信息不存在！');
        }
        if(!is_array($userInfo)){
            $userInfo = json_decode($userInfo,true);
        }
        if(!isset($userInfo[$key])){
            throw new Exception('您所传入的key下没有任何数据信息！');
        }
        return $userInfo[$key];
    }

    public static function getUid()
    {
        return self::getKeyMessage('uid');
    }
}
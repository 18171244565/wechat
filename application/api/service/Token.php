<?php
namespace app\api\service;

class Token
{
    public static function getTokenKey()
    {
        $key = getRandChar();
        $timestamp = $_REQUEST['REQUEST_TIME_FLOAT'];
        $salt = config('secure.saltToken');
        return md5($key.$timestamp.$salt);
    }
}
<?php
namespace app\lib\exception;

class WechatException extends BaseException
{
    public $code = 404;
    public $message = '微信接口调用失败！';
    public $error_code = 600001;
}
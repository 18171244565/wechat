<?php
namespace app\lib\exception;

class TokenException extends BaseException
{
    public $code = 500;
    public $message = 'Token缓存失败！';
    public $error_code = 700001;
}
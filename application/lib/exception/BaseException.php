<?php
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
    public $code = 400 ;
    public $message = "此请求为非法请求";
    public $error_code = 40000;
}
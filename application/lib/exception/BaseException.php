<?php
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
    public $code = 400 ;
    public $message = "此请求为非法请求";
    public $error_code = 40000;

    public function __construct($param = [])
    {
        if(!is_array($param)){
            return ;
        }
        if (array_key_exists('code',$param)){
            $this->code = $param['code'];
        }
        if (array_key_exists('message',$param)){
            $this->message = $param['message'];
        }
        if (array_key_exists('error_code',$param)){
            $this->error_code = $param['error_code'];
        }
    }
}
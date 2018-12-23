<?php
namespace app\lib\exception;

class UserException extends BaseException
{
    protected $code = 400;
    protected $error_code = 80001;
    protected $message = '用户信息不存在！';
}
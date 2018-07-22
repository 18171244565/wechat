<?php
namespace app\lib\exception;

class ParamsException extends BaseException
{
    public $code = 400;
    public $message = '参数错误，请您仔细对照文档检查参数！';
    public $error_code = 100001;

}
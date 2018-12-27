<?php
namespace app\lib\exception;

class ForbiddenException extends BaseException
{
    protected $code = 403;
    protected $message = '对不起，您无权访问当前接口！';
    protected $error_code = '对不起，您无权访问当前接口！';
}
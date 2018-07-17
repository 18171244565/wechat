<?php
namespace app\lib\exception;

class BannerException extends BaseException
{
    public $code = 200;
    public $message = "Banner有问题！";
    public $error_code = 40004;
}
<?php
namespace app\lib\exception;

class BannerException extends BaseException
{
    public $code = 200;
    public $message = "Banner未找到！";
    public $error_code = 40004;
}
<?php
namespace app\lib\exception;

class ProductException extends BaseException
{
    public $code = 404;
    public $message = '对不起，最近无商品上新！';
    public $error_code = 400001;
}
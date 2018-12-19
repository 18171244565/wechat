<?php
namespace app\lib\exception;

class ProductException extends BaseException
{
    public $code = 404;
    public $message = '对不起，查询的商品无任何记录！';
    public $error_code = 400001;
}
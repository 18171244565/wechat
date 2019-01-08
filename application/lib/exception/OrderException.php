<?php
namespace app\lib\exception;

class OrderException extends BaseException
{
    protected $message = '订单商品异常！';
    protected $code = 200;
    protected $error_code = 900001;
}
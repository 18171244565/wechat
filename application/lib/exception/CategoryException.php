<?php
namespace app\lib\exception;
class CategoryException extends BaseException
{
    public $code = 404;
    public $message = "商品分类接口不存在数据！";
    public $error_code = 50000;
}
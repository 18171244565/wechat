<?php
namespace app\lib\exception;

class ThemeException extends BaseException
{
    public $code = 404;
    public $message = '您所要查询的主题无任何数据！';
    public $error_code = 300001;
}
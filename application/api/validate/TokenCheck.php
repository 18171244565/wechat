<?php
namespace app\api\validate;

class TokenCheck extends BaseValidate
{
    protected $rule = [
        'code'=>'require|isNotEmpty'
    ];
    protected $message = [
        'code'=>'code不能为空也不能为一个对象！'
    ];


}
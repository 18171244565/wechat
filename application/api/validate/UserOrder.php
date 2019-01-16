<?php
namespace app\api\validate;

class UserOrder extends BaseValidate
{
    protected $rule = [
        'page'=>'require|isInt',
        'size'=>'require|isInt',
    ];
    protected $message = [
        'page.isInt'=>'您所传的参数page不是一个正整数',
        'page.require'=>'page is must need!',
        'size.isInt'=>'您所传的参数size不是一个正整数',
        'size.require'=>'size is must need!',
    ];
}
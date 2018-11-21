<?php
namespace app\api\validate;

class CountValidate extends BaseValidate
{
    protected $rule = [
        'count'=>'isInt|between:1,15'
    ];
}
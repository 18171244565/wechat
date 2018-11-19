<?php
namespace app\api\validate;



class isInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isInt'

    ];
    protected $message = [
        'id.isInt'=>'您所传的参数id不是一个正整数',
        'id.require'=>'id is must need!',
    ];

}
<?php
namespace app\api\validate;



class isInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isInt'

    ];

    protected function isInt($value,$rule='',$data='',$field='')
    {
        if(preg_match('/^[1-9]\d*$/',$value)){
            return true ;
        }else{
            return $field.':您所传的参数不是一个正整数!';
        }

    }
}
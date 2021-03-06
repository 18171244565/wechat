<?php
namespace app\api\validate;

class AddressNew extends BaseValidate
{
    protected $rule = [
        'name'     => 'require|isNotEmpty',
        'country'  => 'require|isNotEmpty',
        'province' => 'require|isNotEmpty',
        'city'     => 'require|isNotEmpty',
        'mobile'   => 'require|isNotEmpty',
        'detail'   => 'require|isNotEmpty',
    ];
}
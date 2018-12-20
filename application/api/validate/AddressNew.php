<?php
namespace app\api\validate;

class AddressNew extends BaseValidate
{
    protected $rule = [
        'name'     => 'required|isNotEmpty',
        'country'  => 'required|isNotEmpty',
        'province' => 'required|isNotEmpty',
        'city'     => 'required|isNotEmpty',
        'mobile'   => 'required|isNotEmpty',
        'detail'   => 'required|isNotEmpty',
    ];
}
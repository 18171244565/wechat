<?php

namespace app\api\validate;

use think\Validate;

class TestValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email' => 'email'
    ];
    protected $message = [
        'name.max' => '名字的长度不能超过10个字符',
        'email' => '请检查邮箱格式是否正确'
    ];
}
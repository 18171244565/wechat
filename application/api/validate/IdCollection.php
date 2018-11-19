<?php
namespace app\api\validate;

class IdCollection extends BaseValidate
{
    protected $rule = [
        'ids'=>'require|idsMustInt',
    ];
    protected $message=[
        'ids'=>'ids必须为一个以逗号相隔的字符串！'
    ];

    public function idsMustInt($value)
    {
        $params = explode(',',$value);
        if(empty($params)){
            return false;
        }
        $result = true;
        foreach ($params as $param) {
            if(!$this->isInt($param)){
                $result = false;
                break;
            }
        }
        return $result;
    }
}
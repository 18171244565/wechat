<?php
namespace app\api\validate;

use app\lib\exception\ParamsException;

class ProductCheck extends BaseValidate
{
    protected $rule = [
        'products'=>'productCheck'
    ];
    protected $singleRule = [
        'product_id'=>'required|isInt',
        'count'=>'required|isInt'
    ];
    public function productCheck($values)
    {
        if(!is_array($values)){
            throw new ParamsException([
                'message'=>'所传递的参数不为一个数组！'
            ]);
        }
        if(empty($values)){
            throw new ParamsException([
                'message'=>'订单数据不能为空！'
            ]);
        }
        foreach ($values as $value) {
            $this->checkListInfo($value);
        }
        return true;
    }

    protected function checkListInfo($value)
    {
        $baseValidate = new BaseValidate($this->singleRule);
        $result = $baseValidate->check($value);
        if(!$result){
            throw new ParamsException([
                    'message'=>'订单传递参数校验不通过！'
                        ]
            );
        }
    }
}
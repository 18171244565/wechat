<?php
namespace app\api\controller\v1;

use app\api\validate\CountValidate;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

class Product extends Common
{
    public function getRecent($count=15)
    {
        (new CountValidate())->goCheck();
        $result = ProductModel::rencent($count);
        if(!$result){
            throw new ProductException();
        }
        return $result;
    }
}
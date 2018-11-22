<?php
namespace app\api\controller\v1;

use app\api\validate\CountValidate;
use app\api\model\Product as ProductModel;
use app\api\validate\isInt;
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

    public function categoryGoods($id='')
    {
        (new isInt())->goCheck();
        $result = ProductModel::getCateGoods($id);
        if($result->isEmpty()){
            throw new ProductException();
        }
        $result->hidden(['summary']);
        return $result;
    }
}
<?php
namespace app\api\controller\v1;

use app\api\validate\isInt;
use app\api\service\Pay as payService;
class Pay extends Common
{
    protected $beforeActionList = [
        'checkUserScope'=>['only'=>'getPreOrder']
    ];
    //订单支付预操作
    public function getPreOrder($id='')
    {
        (new isInt())->goCheck();
    }
}
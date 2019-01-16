<?php
namespace app\api\controller\v1;

use app\api\validate\isInt;
use app\api\validate\ProductCheck;
use app\api\service\Order as orderService;
use app\api\service\Token as tokenService;
use app\api\validate\UserOrder;
use app\api\model\Order as OrderModel;
class Order extends Common
{
    protected $beforeActionList=[
        //在执行second或者third方法前先执行first  先执行的方法名=>['only'=>'方法名1,方法名2....']
        'checkUserScope'=>'placeOrder',
        'checkScope'=>'getUserOrder,getOrderDetail'
    ];

    public function placeOrder()
    {
        (new ProductCheck())->goCheck();
        $uid = (new tokenService)->getUid();
        $oProducts = input('post.products/a');
        $result = (new orderService)->place($uid,$oProducts);
        return $result;
    }

    public function getUserOrder($page,$size)
    {
        (new UserOrder())->goCheck();
        $result = OrderModel::getUserPage($page,$size);
        return $result;
    }

    public function getOrderDetail($id)
    {
        (new isInt())->goCheck();
        $hidden = ['prepay_id'];
        $orderDetail = OrderModel::get($id)->hidden($hidden);
        if(!$orderDetail){
            return ['data'=>null];
        }
        return ['data'=>$orderDetail];
    }
}
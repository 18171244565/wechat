<?php
namespace app\api\controller\v1;

use app\api\validate\ProductCheck;
use app\api\service\Order as orderService;
use app\api\service\Token as tokenService;
class Order extends Common
{
    protected $beforeActionList=[
        //在执行second或者third方法前先执行first  先执行的方法名=>['only'=>'方法名1,方法名2....']
        'checkUserScope'=>'placeOrder'
    ];

    public function placeOrder()
    {
        (new ProductCheck())->goCheck();
        $uid = (new tokenService)->getUid();
        $oProducts = input('post.products/a');
        (new orderService)->place($uid,$oProducts);
    }
}
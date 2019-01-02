<?php
namespace app\api\service;

use app\api\model\Product;
use app\lib\exception\OrderException;

class Order
{
    protected $uid;
    protected $oProducts;
    protected $products;

    public function place($uid,$oProducts)
    {
        $this->uid = $uid;
        $this->oProducts = $oProducts;
        $this->products = $this->getProducts($this->oProducts);
        $status = $this->getOrderStatus();
        if(!$status['pass']){
            return $status['order_id'] = -1;
        }
        //验证可以下单之后，然后进行创建订单
        
    }

    public function getProducts($oProducts)
    {
        $order_ids = array_column($oProducts,'product_id');
        $orderList = Product::all($order_ids)->visible([
            'id','price','stock','main_img_url','name'
        ])->toArray();
        return $orderList;
    }

    public function getOrderStatus()
    {
        $products = cast_index_to_key($this->products,'id');
        $pass = true;
        $orderPrice = 0;
        $pStatusArray = [];
        foreach ($this->oProducts as $oProduct) {
            if(!isset($products[$oProduct['product_id']])){
                throw new OrderException([
                    'message'=>'订单商品不存在！'
                ]);
            }

            //检查库存
            $haveStock = $products[$oProduct['product_id']]['stock']>=$oProduct['count']?true:false;
            $subPrice = $products[$oProduct['product_id']]['price']*$oProduct['count'];
            $pStatusArray[] = [
                'id'=>$products[$oProduct['product_id']]['id'],
                'haveStock'=>$haveStock,
                'count'=>$oProduct['count'],
                'name'=>$products[$oProduct['product_id']]['name'],
                'totalPrice'=>$subPrice
            ];
            if($pass && !$haveStock){
                $pass = false;
            }
            $orderPrice+=$subPrice;
        }
        return [
            'pass'         => $pass,
            'orderPrice'   => $orderPrice,
            'pStatusArray' => $pStatusArray
        ];
    }
}
<?php
namespace app\api\service;

use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use app\lib\exception\OrderException;
use app\api\model\Order as orderModel;
use think\Db;
use think\Exception;

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
            $status['order_id'] = -1;
            return $status;
        }
        //验证可以下单之后，然后进行创建订单
        $orderSnap = $this->getOrderSnap($status);
        $result = $this->createOrder($orderSnap);
        $result['pass'] = true;
        return $result;
    }

    public function createOrder($orderSnap)
    {
        try{
            Db::startTrans();
            $order = new orderModel();
            $order->order_no = self::makeOrderNo();
            $order->user_id = $this->uid;
            $order->total_price = $orderSnap['orderPrice'];
            $order->snap_img = $orderSnap['snapImg'];
            $order->snap_name = $orderSnap['snapName'];
            $order->total_count = $orderSnap['totalCount'];
            $order->snap_items = $orderSnap['pStatus'];
            $order->snap_address = $orderSnap['snapAddress'];
            $order->save();
            $order_id = $order->id;
            $create_time = $order->create_time;

            foreach ($this->oProducts as &$oProduct) {
                $oProduct['order_id'] = $order_id;
            }
            (new OrderProduct)->saveAll($this->oProducts);
            Db::commit();
            $result = [
                'order_no'=>$order->order_no,
                'order_id'=>$order_id,
                'createTime'=>$create_time
            ];

        }catch (Exception $exception){
            Db::rollback();
            $result = [
                'order_no'=>'',
                'order_id'=>'-1',
                'createTime'=>''
            ];
        }
        return $result;
    }
    private function getOrderSnap($status=[])
    {
        $userAddress = UserAddress::where('user_id','=',$this->uid)->find()->toArray();
        $orderSnap = [
            'orderPrice'=>$status['orderPrice'],
            'totalCount'=>$status['totalCount'],
            'pStatus'=>json_encode($status['pStatusArray'],true),
            'snapAddress'=>json_encode($userAddress,true),
            'snapName'=>$this->products[0]['name'],
            'snapImg'=>$this->products[0]['main_img_url']
        ];
        if($orderSnap['totalCount']>1){
            $orderSnap['snapName'].='等'.$status['totalCount'].'件商品';
        }
        return $orderSnap;
    }

    public function checkPayStock($order_id)
    {
        $oProducts = OrderProduct::where('order_id','=',$order_id)->select()->toArray();
        $this->oProducts = $oProducts;
        $this->products = $this->getProducts($oProducts);
        return $this->getOrderStatus();
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
        $totalCount = 0 ;
        $message = '下单成功！';
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
                $message = $products[$oProduct['product_id']]['name'].'库存不足！';
            }
            $totalCount+=$oProduct['count'];
            $orderPrice+=$subPrice;
        }
        return [
            'pass'         => $pass,
            'orderPrice'   => $orderPrice,
            'pStatusArray' => $pStatusArray,
            'totalCount'   => $totalCount,
            'message'      => $message
        ];
    }
    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }
}
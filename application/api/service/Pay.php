<?php
namespace app\api\service;
use app\api\service\Order as orderService;
use app\api\service\Token as tokenService;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\ParamsException;
use app\api\model\Order as orderModel;
use think\facade\Log;

class Pay
{
    private $orderId;
    private $orderNo;
    public function __construct($id='')
    {
        if(isset($id) && $id>0){
            throw new ('订单号不能为空！');
        }
        $this->orderId = $id;
    }
    public function payOrder($id)
    {
        //检查库存
        $this->checkOrderValid($id);
        $orderService = new orderService;
        $stock_ret = $orderService->checkPayStock($id);
        if(!$stock_ret['pass']){
            throw new ParamsException([
                'message'=>$stock_ret['message'],
                'error_code'=>'90001'
            ]);
        }
        $this->makeWxPreOrder($stock_ret['orderPrice']);

    }

    public function makeWxPreOrder($totalPrice)
    {
        $openid = tokenService::getKeyMessage('openid');
        if(empty($openid)){
            throw new ParamsException('openid不存在！');
        }
        $WxOrderData = new \WxPayUnifiedOrder();
        $WxOrderData->SetOut_trade_no($this->orderNo);
        $WxOrderData->SetTrade_type('JSAPI');
        $WxOrderData->SetTotal_fee($totalPrice*100);
        $WxOrderData->SetBody("零食商贩");
        $WxOrderData->SetOpenid($openid);
        $WxOrderData->SetNotify_url('');
        $this->getPaySign($WxOrderData);
    }

    public function getPaySign($WxOrderData)
    {
        $Wxorder = \Extend\Wxpay\WxPayApi::unifiedOrder($WxOrderData);
        if($Wxorder['return_code']!='SUCCESS' || $Wxorder['result_code']!='SUCCESS'){
            Log::record($Wxorder,'error');
            Log::record('获取预支付订单失败！','error');
        }
    }
    public function checkOrderValid($id)
    {
        $order_info = orderModel::where('id','=',$id)->find();
        if(!$order_info){
            throw new OrderException('订单不存在！');
        }
        $user_id = $order_info->user_id;
        if(!$user_id){
            throw new OrderException('订单user_id不存在！');
        }
        $currentUid = Token::getUid();
        if($user_id!=$currentUid){
            throw new OrderException('该订单不属于当前用户所创建！');
        }
        if($order_info->status!=OrderStatusEnum::UNPAID){
            throw new OrderException([
                'code'=>'200',
                'error_code'=>'90003',
                'message'=>'该订单不属于当前用户所创建！'
            ]);
        }
        $this->orderNo = $order_info->order_no;
        return true;
    }
}
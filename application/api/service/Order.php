<?php
namespace app\api\service;

use app\api\model\Product;

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
    }

    public function getProducts($oProducts)
    {
        $order_ids = array_column($oProducts,'product_id');
        $orderList = Product::all($order_ids)->visible([
            'id','price','stock','main_img_url','name'
        ])->toArray();
        return $orderList;
    }
}
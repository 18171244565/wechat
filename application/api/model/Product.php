<?php
namespace app\api\model;

use think\Model;

class Product extends BaseModel
{
    protected $hidden = [
        'delete_time',
        'category_id',
        'from',
        'create_time',
        'update_time',
        'pivot',
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->getPrefixUrl($value, $data);
    }

    public static function rencent($count)
    {
        $result = self::limit($count)->order('create_time desc')->select();
        return $result;
    }

    public static function getCateGoods($id)
    {
        $result = self::where('category_id','=',$id)->select();
        return $result;
    }
    public function properties(){
        return $this->hasMany('ProductProperty','product_id','id');
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage','product_id','id');
    }
    public static function getOne($id)
    {
        //return self::with(['properties'])->with(['imgs.imgList'])->find($id);
        //为了实现产品详情图片按照闭包的方式去查询并给出排序
        return self::with(['properties'])->with(['imgs'=>function($query){
            $query->with('imgList')->order('order asc');
        }])->find($id);
    }
}
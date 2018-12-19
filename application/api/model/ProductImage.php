<?php
namespace app\api\model;

use think\Model;

class ProductImage extends Model
{
    protected $hidden = [
        "id",
        "img_id",
        "delete_time",
    ];
    public function imgList()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}
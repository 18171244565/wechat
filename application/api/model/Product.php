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
}
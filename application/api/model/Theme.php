<?php
namespace app\api\model;

use think\Model;

class Theme extends BaseModel
{
    protected $hidden = [
        "topic_img_id",
        "delete_time",
        "head_img_id",
        "update_time",
    ];
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','id');
    }

    public function themeProduct()
    {
        //多对多查询第一个参数是关联的模型。第二参数为多对多中的表名，第三关联模型的id 四参数为本关联的模型表id
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    public static function getThemeInfo($id)
    {
        $result = self::with(['themeProduct','topicImg','headImg'])->find($id);
        return $result;
    }
}
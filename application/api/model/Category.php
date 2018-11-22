<?php
namespace app\api\model;


class Category extends BaseModel
{
    public function topImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }
}
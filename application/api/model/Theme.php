<?php
namespace app\api\model;

use think\Model;

class Theme extends BaseModel
{
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public function headImg()
    {
        $this->belongsTo('Image','head_img_id','id');
    }
}
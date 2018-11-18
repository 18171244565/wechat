<?php
namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    public function getPrefixUrl($value,$data)
    {
        $url = $value;
        if($data['from']==1){
            $url = config('setting.img_prefix').$value;

        }
        return $url;
    }
   /* public function getUrlAttr($value,$data)
    {
        $url = $value;
        if($data['from']==1){
            $url = config('setting.img_prefix').$value;

        }
        return $url;
    }*/
}
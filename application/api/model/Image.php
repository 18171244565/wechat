<?php
namespace app\api\model;

use think\Model;

class Image extends Model
{
    protected $visible = ['url'];

    public function getUrlAttr($value,$data)
    {
        $url = $value;
        if($data['from']==1){
           $url = config('setting.img_prefix').$value;

        }
        return $url;
    }
}
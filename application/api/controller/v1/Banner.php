<?php
namespace app\api\controller\v1;

use app\api\lib\exception\BannerException;

class Banner extends Common
{
    public function getBanner($id)
    {

        $res = model('Banner')->getBannerInfo($id);
        if(!$res){
            throw new BannerException();
        }
       // return $res;
    }
}
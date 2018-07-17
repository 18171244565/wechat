<?php
namespace app\api\controller\v1;

use app\lib\exception\BannerException;
use think\Exception;

class Banner extends Common
{
    public function getBanner($id)
    {
        $res = model('Banner')->getBannerInfo($id);
        if(!$res){
            throw new BannerException('对不起您需要的banner暂时未找到！');
        }

        return $res;
    }
}
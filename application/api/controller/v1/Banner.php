<?php
namespace app\api\controller\v1;

use app\api\model\BannerModel;
use app\api\validate\isInt;
use app\lib\exception\BannerException;
use think\Exception;
class Banner extends Common
{
    public function getBanner($id)
    {
        (new isInt())->goCheck();
        $res = BannerModel::getBannerInfo($id);
        if(!$res){
            throw new BannerException();
        }
        return json($res);
    }
}
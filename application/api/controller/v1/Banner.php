<?php
namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\isInt;
use app\lib\exception\BannerException;
class Banner extends Common
{
    public function getBanner($id)
    {
        (new isInt())->goCheck();
        //$res = BannerModel::get($id);
        //$res = (new BannerModel)->get($id);
        $res = BannerModel::getBannerInfo($id);
       //$res = BannerModel::with(['bannerItems','bannerItems.img'])->find($id);
       // $res = $res->visible(['update_time','description']);
        if(!$res){
            throw new BannerException();
        }
        return $res;
    }
}
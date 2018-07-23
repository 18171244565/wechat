<?php
namespace app\api\model;

use app\lib\exception\BannerException;
use think\Db;
use think\Exception;
use think\Model;

class BannerModel extends Model
{
   public static function getBannerInfo($id){
        $result = Db::query("select * from banner_item where banner_id=?",[$id]);

        return $result;
   }
}
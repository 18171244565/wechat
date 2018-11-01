<?php
namespace app\api\model;

use app\lib\exception\BannerException;
use think\Db;
use think\db\Query;
use think\Exception;
use think\Model;

class Banner extends Model
{
    protected $hidden = ['id','update_time'];
    public function bannerItems()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }
   public static function getBannerInfo($id){
       // $result = Db::query("select * from banner_item where banner_id=?",[$id]);
       //$result = Db::table('banner_item')->where('banner_id','=',$id)->select();
       //$result = Db::table('banner_item')->where(['banner_id'=>$id])->select();

       /*$result = Db::table('banner_item')->where(function ($query) use ($id){
           $query->where('banner_id','=',$id);
       })->select();*/
       $result = self::with(['bannerItems','bannerItems.img'])->find($id);
       return $result;
   }
}
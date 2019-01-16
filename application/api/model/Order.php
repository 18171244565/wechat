<?php
namespace app\api\model;
use app\api\service\Token as tokenService;
class Order extends BaseModel
{
    protected $autoWriteTimestamp=true;

    public function getSnapItemsAttr($value)
    {
        if(empty($value)){
            $paramsValue = '';
        }else{
            $paramsValue = json_decode($value,true);
        }
        return $paramsValue;
    }
    public function getSnapAddressAttr($value)
    {
        if(empty($value)){
            $paramsValue = '';
        }else{
            $paramsValue = json_decode($value,true);
        }

        return $paramsValue;
    }
    public static function getUserPage($page,$size)
    {
        $hidden = ['snap_items','snap_address'];
        $uid = tokenService::getKeyMessage('uid');
        $result = self::where('user_id','=',$uid)->order('id desc')->paginate($size,true,['page'=>$page])->hidden($hidden)->toArray();
        if(empty($result)){
           return $data = [
               'data'=>'',
               'curpage'=>$page
           ];
        }
        return $data = [
            'data'=>$result,
            'curpage'=>$page
        ];
    }
}
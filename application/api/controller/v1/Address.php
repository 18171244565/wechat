<?php
namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use \app\api\service\Token as ServiceToken;
use \app\api\model\User as UserModel;
use app\lib\exception\UserException;
use think\facade\Request;

class Address
{
    public function createAndUpdate()
    {
        (new AddressNew())->goCheck();
        $uid = ServiceToken::getUid();
        //$postData = Request::instance()->param();
        $postData = [];
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $userAddress = $user->address;
        if(!$userAddress){
             $user->address()->save($postData);
        }else{
            $user->address->save($postData);
        }
        return ['message'=>'操作成功！','code'=>'200','data'=>''];
    }
}
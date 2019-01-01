<?php
namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use \app\api\service\Token as ServiceToken;
use \app\api\model\User as UserModel;

use app\lib\exception\UserException;

class Address extends Common
{
    protected $beforeActionList=[
        //在执行second或者third方法前先执行first  先执行的方法名=>['only'=>'方法名1,方法名2....']
        'checkScope'=>'createAndUpdate'
    ];


    /* protected $beforeActionList=[
         //在执行second或者third方法前先执行first  先执行的方法名=>['only'=>'方法名1,方法名2....']
         'first'=>'second,third'
     ];

     public function first()
     {
         echo 'first';
     }
     public function second()
     {
         echo 'second';
     }
     public function third()
     {
         echo 'third';
     }*/

    public function createAndUpdate()
    {
        $AddressNew = new AddressNew();
        $AddressNew->goCheck();
        //$postData = Request::instance()->param();
        $postData = $AddressNew->getPostData(input('post.'));
        $uid = ServiceToken::getUid();
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
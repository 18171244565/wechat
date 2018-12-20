<?php
namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use \app\api\service\Token as ServiceToken;
class Address
{
    public function createAndUpdate()
    {
        (new AddressNew())->goCheck();
        $uid = ServiceToken::getUid();
    }
}
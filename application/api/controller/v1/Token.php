<?php
namespace app\api\controller\v1;

use app\api\service\UserToken;
use app\api\validate\TokenCheck;

class Token extends Common
{
    public function getToken($code='')
    {
        (new TokenCheck())->goCheck();
        $obj = new UserToken($code);
        $token = $obj->get();
        return $token;
    }
}
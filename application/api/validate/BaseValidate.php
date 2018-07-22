<?php
namespace app\api\validate;

use app\lib\exception\ParamsException;
use think\Exception;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http请求里面的所有参数进行校验
        $params = Request::instance()->param();
        $result = $this->check($params);
        if(!$result){
            $error = $this->getError();
            $exception = new ParamsException ([
                'message'=>$error
            ]);
            throw $exception;
        }else{
            return true;
        }
    }
}
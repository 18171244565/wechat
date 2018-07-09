<?php
namespace app\api\validate;

use think\Exception;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http请求里面的所有参数进行校验
        $params = Request::instance()->param();
        $result = $this->batch()->check($params);
        if(!$result){
            $error = $this->getError();
            //throw new Exception($error);
            return $error;
        }else{
            return true;
        }
    }
}
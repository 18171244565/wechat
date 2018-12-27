<?php
namespace app\api\validate;

use app\lib\exception\ParamsException;
use app\lib\exception\UserException;
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
            $exception = new ParamsException ([
                'message'=>is_array($error)?json_encode($error):$error
            ]);
            throw $exception;
        }else{
            return true;
        }

    }
    protected function isInt($value,$rule='',$data='',$field='')
    {
        if(preg_match('/^[1-9]\d*$/',$value)){
            return true ;
        }else{
            return false;
        }

    }
    public function isNotEmpty($value)
    {
        $value = trim($value);
        if(empty($value) && !is_string($value)){
            return false;
        }
        return true;
    }
    //过滤post提交中一系列无用的参数
    public function getPostData($params)
    {
        if(isset($params['token']) || isset($params['user'])){
            throw new UserException([
                'message'=>'提交参数中不能出现系统敏感的参数字符！'
            ]);
        }
        $newParams = [];
        foreach ($this->rule  as $key=>$item) {
            $newParams[$key] = $params[$key];
        }
        return $newParams;
    }
}
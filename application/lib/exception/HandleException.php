<?php
namespace app\lib\exception;


use think\exception\Handle;
use think\facade\Log;
use think\facade\Request;

class HandleException extends Handle
{
    public $code;
    public $message;
    public $error_code;
    public function render (\Exception $e){
        if($e instanceof BaseException){
            $this->code = $e->code;
            $this->message = $e->message;
            $this->error_code = $e->error_code;
        }else{
            $this->code = '500';
            $this->message = '服务器内部错误！';
            $this->error_code = '999';
            $this->recordErrorLog($e);
        }
        $request = Request::instance();
        $res = [
            'url'=>$request->domain().$request->url(),
            'message'=>$this->message,
            'error_code'=>$this->error_code,
        ];
        return json($res,$this->code);

    }

    public function recordErrorLog($e)
    {
        Log::write($e->getMessage(),'error');
    }
}
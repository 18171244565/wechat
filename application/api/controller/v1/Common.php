<?php
namespace app\api\controller\v1;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use \app\api\service\Token as ServiceToken;
use think\Controller;

class Common extends Controller
{
    //检查访问者是否是管理员或者是用户
    public function checkScope()
    {
        $scope = ServiceToken::getKeyMessage('scope');
        if(!$scope){
            throw new TokenException('Token不存在或者已经过期！');
        }
        if($scope<ScopeEnum::User){
            throw new ForbiddenException();
        }else{
            return true;
        }
    }
    //检查权限是否是用户访问
    public function checkUserScope()
    {
        $scope = ServiceToken::getKeyMessage('scope');
        if(!$scope){
            throw new TokenException('Token不存在或者已经过期！');
        }
        if($scope!=ScopeEnum::User){
            throw new ForbiddenException();
        }else{
            return true;
        }
    }
}
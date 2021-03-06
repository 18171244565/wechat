<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 生成应用公共文件
    '__file__' => ['common.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
   /* 'demo'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Index', 'Test', 'UserType'],
        'model'      => ['User', 'UserType'],
        'view'       => ['index/index'],
    ],*/
    'index'     => [
        '__file__'   => ['common.php','index.html'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Index', 'Test', 'UserType','Common'],
        'model'      => ['User', 'UserType'],
        'view'       => ['index/index'],
    ],
    // 其他更多的模块定义
    'api' => [
        '__file__' => ['common.php', 'index.html'],
        '__dir__' => ['service','behavior', 'controller/v1', 'model', 'view', 'validate'],
        'controller\v1' => ['Pay','Order','Address','Banner', 'Common','Index','Theme','Product','Token'],
        'model' => ['OrderProduct','UserAddress','Order','Address','ProductImage','ProductProperty','User','Category','User', 'BaseModel','Banner','BannerItem','Image','Theme','Product'],
        'view' => ['index/index'],
        'validate' => ['UserOrder','ProductCheck','AddressNew','TokenCheck','IdCollection','isInt','BaseValidate','CountValidate'],
        'service'=>['Pay','Order','UserToken','Token']
    ],
    'lib' => [
        '__file__' => ['common.php', 'index.html'],
        '__dir__' => ['exception','enum'],
        'exception' => ['OrderException','ForbiddenException','UserException','TokenException','WechatException','CategoryException','ProductException','ThemeException','paramsException','HandleException','BaseException','BannerException'],
        'enum'=>['ScopeEnum','OrderStatusEnum']
    ],
];

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


//Route::get('hello', 'index/index/hello','get');
//Route::any('index', 'index/index/index');
//Route::rule('路由表达式', '路由地址','请求类型','路由参数（数组）','变量规则（数组）');
Route::rule('hello/:id','index/index/hello','post|get');
//Route::rule('index','index/index/index');
Route::get('api/:version/banner/:id?', 'api/:version.Banner/getBanner');
Route::get('api/:version/theme', 'api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id?', 'api/:version.Theme/getComplexOne');

Route::get('api/:version/category/all', 'api/:version.Category/categoryList');

Route::post('api/:version/user/token', 'api/:version.Token/getToken');

Route::group('api/:version/product/',function(){
    Route::get(':id', 'api/:version.Product/getGoodsInfo',[],[':id'=>'{1,9}\d*']);
    Route::get('recent', 'api/:version.Product/getRecent');
    Route::get('category', 'api/:version.Product/categoryGoods');
});
Route::post('api/:version/address', 'api/:version.Address/createAndUpdate');
Route::get('api/:version/third', 'api/:version.Address/third');
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::get('api/:version/order/pay/:id', 'api/:version.Pay/getPreOrder');
Route::get('api/:version/order/byuser', 'api/:version.order/getUserOrder');
Route::get('api/:version/order/:id', 'api/:version.order/getOrderDetail',[],[':id'=>'{1,9}\d*']);
return [

];

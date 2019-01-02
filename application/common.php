<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * @param string $url get请求地址
 * @param int $httpCode 返回状态码
 * @return mixed
 */
function curl_get($url, &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //不做证书校验,部署在linux环境下请改为true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file_contents = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $file_contents;
}
/*function curl_post($url='',$data){
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    curl_setopt ( $ch, CURLOPT_POST, 1 ); //启用POST提交
    $file_contents = curl_exec ( $ch );
    curl_close ( $ch );
    return $file_contents;
}*/
function getRandChar($length=32)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    for ($i = 0;
         $i < $length;
         $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}



function fromArrayToModel($m , $array)
{
    foreach ($array as $key => $value)
    {
        $m[$key] = $value;
    }
    return $m;
}
function cast_index_to_key($arr, $index, $separator='-'){
    $new_arr = array();
    foreach ($arr as $_row) {
        if(is_array($index) && !empty($index)){
            $arr_index = '';
            foreach($index as $val){
                $arr_index .= $_row[$val].$separator;
            }
            $arr_index = (!empty($arr_index) ? substr($arr_index, 0, -1) : $arr_index);
        }else{
            $arr_index = $_row[$index];
        }
        $new_arr[$arr_index] = $_row;
    }
    return $new_arr;
}
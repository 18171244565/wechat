<?php

namespace app\api\controller;


class Banner extends Common
{
    public function getBanner($id)
    {
        $data = [
            'name' => 'pipi12111111111111111',
            'email' => '261636048qq.com'
        ];
        $validate = validate('TestValidate');
        $result = $validate->batch()->check($data);
        $msg = $validate->getError();
        //$msg = $this->validate($data,'TestValidate');
        /*$validate = new TestValidate();
        $result = $validate->batch()->check($data);
        $msg = $validate->getError();*/
        dump($result);

    }
}
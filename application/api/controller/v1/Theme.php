<?php
namespace app\api\controller\v1;


use app\api\validate\IdCollection;
use app\api\model\Theme as ThemeModel;
class Theme extends Common
{
    /**
     *
     *@url theme?ids=id1,id2....
     *
     */
    public function getSimpleList($ids='')
    {
        (new IdCollection())->goCheck();
        //$result = ThemeModel::with(['topicImg','headImg'])->select($ids);
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')->select($ids);
        return $result;
    }
}
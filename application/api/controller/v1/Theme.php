<?php
namespace app\api\controller\v1;


use app\api\validate\IdCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\isInt;
use app\lib\exception\ThemeException;

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
        $result = $result->toArray();
        if(empty($result)){
            throw new ThemeException();
        }
        return $result;
    }

    public function getComplexOne($id)
    {
        (new isInt())->goCheck();
        $result = ThemeModel::getThemeInfo($id);
        if(!$result){
            throw new ThemeException();
        }
        return $result;
    }
}
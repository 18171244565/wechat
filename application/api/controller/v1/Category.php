<?php
namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category extends Common
{
    public function categoryList()
    {
        $result = CategoryModel::all([],'topImg');
        if($result->isEmpty()){
            throw new CategoryException();
        }
        return $result;
    }
}
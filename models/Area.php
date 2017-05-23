<?php
namespace zqzlk\models;
use zqzlk\lib\ActiveRecord;

/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 12:40
 */
class Area extends ActiveRecord
{
    public function tableName()
    {
        $this->_table = 'zlk_area';
    }

    public static function Name($id){
        $name = "";
        switch ($id) {
            case 0: $name =  "洲际赛事"; break;
            case 1: $name =  "欧洲赛事"; break;
            case 2: $name =  "美洲赛事"; break;
            case 3: $name =  "亚洲赛事"; break;
            case 4: $name =  "大洋洲赛事"; break;
            case 5: $name =  "非洲赛事"; break;
        }
        return $name;
    }
}
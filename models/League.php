<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 15:49
 */

namespace zqzlk\models;


use zqzlk\lib\ActiveRecord;

class League extends ActiveRecord
{
    public function tableName()
    {
        $this->_table = 'zlk_league';
    }
}
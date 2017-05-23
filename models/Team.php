<?php

namespace zqzlk\models;


use zqzlk\lib\ActiveRecord;

class Team extends ActiveRecord
{
    public function tableName()
    {
        $this->_table = 'zlk_team';
    }
}

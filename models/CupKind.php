<?php

namespace zqzlk\models;


use zqzlk\lib\ActiveRecord;

class CupKind extends ActiveRecord
{
    public function tableName()
    {
        $this->_table = 'zlk_cup_kind';
    }
}

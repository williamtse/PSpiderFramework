<?php
namespace zqzlk\models;

use zqzlk\lib\ActiveRecord;

class GroupScore extends ActiveRecord {
	public function tableName()
    {
        $this->_table = 'zlk_group_score';
    }
}
?>
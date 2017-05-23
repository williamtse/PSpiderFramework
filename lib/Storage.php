<?php

namespace zqzlk\lib;


use zqzlk\lib\Interfaces\StorageInterface;

abstract class Storage extends Base implements StorageInterface
{
    public $datas;//js datas
    public $datasArr;//php array

    protected $season;
    protected $leagueId;
    protected $_isCup=false;

    public function setIsCup($isCup=true){
        $this->_isCup = $isCup;
    }

    public function setSeason($season){
        $this->season = $season;
    }

    public function setLeagueId($leagueId){
        $this->leagueId = $leagueId;
    }

    public function getDatas(){
        return $this->datas;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 16:26
 */

namespace zqzlk\caijis;


use zqzlk\lib\Caiji;
use zqzlk\lib\Interfaces\CaijiInterface;

class Seasons extends Caiji implements CaijiInterface
{
    public $leagueId;
    public function init($configs = [])
    {
        $leagueId = $configs['LeagueId'];
        $this->leagueId = $leagueId;
        $this->url = "http://zq.win007.com/jsData/LeagueSeason/sea$leagueId.js";
    }

}
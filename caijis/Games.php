<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 16:11
 */
///jsData/matchResult/2014/c75.js?version=2017052117 世界杯
//http://zq.win007.com/cn/CupMatch/103.html 欧冠杯
namespace zqzlk\caijis;


use zqzlk\lib\Caiji;
use zqzlk\lib\Interfaces\CaijiInterface;

class Games extends Caiji  implements CaijiInterface
{
    public function init($configs=[])
    {
        $season = $configs['Season'];
        $leagueId = $configs['LeagueId'];
        $type = $configs['type'];
        if(!$type) $sc = 's';
        else $sc = 'c';
        $this->url = "http://zq.win007.com/jsData/matchResult/$season/$sc$leagueId.js";
    }
}

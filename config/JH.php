<?php
/**
 * http://zq.win007.com/jsData/matchResult/2016-2017/s36.js?version=2017051315
 * jh[]数组下标映射
 * 例：[1247648,36,-1,'2016-08-13 19:30',384,59,'2-1','1-0','英冠4','1',-0.25,0,'2/2.5','1',1,1,1,1,0,0,'','ENG LCH-4','1']
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 17:47
 */

namespace zqzlk\config;

/**
 * Class JH
 * @package zqzlk\config
 */
class JH
{
    public static $preg = '/jh\["([S|R|_|G]+)([0-9]+)([A-Z]*)"\] = \[([^\n]+)\];/';
    public static $gameId = 0;
    public static $leagueId = 1;
    public static $status = 2;
    public static $datetime = 3;
    public static $hteamId = 4;
    public static $gteamId = 5;
    public static $score = 6;
    public static $haf_score=7;
    public static $hrank = 8;
    public static $crank = 9;
    public static $rq_cq_pk = 10;
    public static $rq_haf_pk = 11;
    public static $dx_cq_pk = 12;
    public static $dx_haf_pk =13;
}

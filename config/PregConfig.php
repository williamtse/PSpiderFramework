<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/14
 * Time: 14:50
 */

namespace zqzlk\config;


class PregConfig
{
    /**
     * 杯赛分组 jh["G12836E"] = [...];
     * 杯赛小组积分 jh["S12836E"] = [...];
     * 杯赛非分组 jh["G12836"]= [...];
     * 联赛 jh["R_12"] = [...];
     * @var string
     */
    public static $jh = '/jh\["[G|S|R_]([0-9]+)([A-Z]*)"\] = (\[[^\n]+\]);/';

    /**
     * 杯赛所有轮次，联赛没有这个数组
     * @var string
     */
    public static $arrCupKind = '/arrCupKind = (\[[^;]+\]);/';

    /**
     * 杯赛信息，联赛没有这个数组
     * @var string
     */
    public static $arrCup = '/arrCup = (\[[^\n]+\]);/';

    /**
     * 联赛信息，杯赛没有这个数组
     * @var string
     */
    public static $arrLeague = '/arrLeague = (\[[^\n]+\]);/';

    /**
     * 杯赛或者联赛的所有参加队伍信息
     * @var string
     */
    public static $arrTeam = '/arrTeam = (\[[^\n]+\]);/';
}

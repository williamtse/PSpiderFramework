<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 18:10
 */

namespace zqzlk\config;

/**
 * [36,'英格兰超级联赛','英格蘭超級聯賽','English Premier League','2016-2017','#FF3333',
 * 'league_match/images/20160816164328.png',38,37,'英超','英超','ENG PR',
 * '　　英格兰足球超级联赛共由20支球队组成，采取双循环赛制（每支球队分别以主、客场身份和其他球队交锋两次）。单场比赛积分计算方法是胜者得3分、负者得0分、平局则双方各得1分，赛季末按累计积分高低排名。积分相同的球队由淨胜球和总进球数等来决定排名，如果争冠球队通过以上条件仍不分上下就需要进行附加赛。<br/>　　联赛前三名直接参加下赛季冠军联赛小组赛，第四名取得参加下赛季冠军联赛外围赛的资格，第五名参加下赛季欧霸杯（英格兰足总盃冠军和联赛盃冠军也参加欧霸杯，如果足总盃冠军已经取得欧战资格，则其名额给足总盃亚军，而如果联赛盃冠军已经取得欧战资格，则其名额给联赛中排名靠前的球队）。另外，本赛季英超联赛规定升3降3，联赛排名榜尾的3支球队下赛季将降到英冠。'];
 * Class League
 * @package zqzlk\config
 */
class League
{
    public $leagueId = 0;
    public $name_zh = 1;
    public $name_tw = 2;
    public $name_en = 3;
    public $season = 4;
    public $color=5;
    public $img = 6;
    public $name_short_zh = 9;
    public $name_short_tw =10;
    public $name_short_en =11;
    public $introduction = 12;
}
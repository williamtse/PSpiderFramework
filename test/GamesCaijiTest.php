<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 16:47
 */

namespace test;
use PHPUnit_Framework_TestCase;
use zqzlk\caijis\Games;
use zqzlk\caijis\Seasons;
use zqzlk\storages\Game;
use zqzlk\storages\Season;

class GamesCaijiTest extends PHPUnit_Framework_TestCase
{
    public function testSeasonCaiji(){
        $LeagueId = 36;
        $ss = new Seasons();
        $ss->init(['LeagueId'=>$LeagueId]);
        $statusCode = $ss->getContent();
        $this->assertEquals(200,$statusCode);
        return $ss;
    }

    /**
     * @depends testSeasonCaiji
     */
    public function testSeasonQuery($res){
        $ss = new Season();
        $body = $res->getBody();
        $ss->leagueId = $res->leagueId;
        $res = $ss->queryContent($body);
        $this->assertTrue($res);
        return $ss;
    }

	//联赛采集
    public function testGamesCaijiS(){
        $gcj = new Games();
        $gcj->init(['Season'=>'2016-2017','LeagueId'=>'36','type'=>1]);
        $status = $gcj->getContent();
        $this->assertEquals(200,$status);
        return $gcj->getBody();
    }
	//杯赛采集
	public function testGamesCaijiC(){
		$gcj = new Games();
		$gcj->init(['Season'=>'2016-2017','LeagueId'=>'103','type'=>2]);
		$status = $gcj->getContent();
		$this->assertEquals(200,$status);
		return $gcj->getBody();
	}

    /**
     * @depends testGamesCaijiS
     */
    public function testGameQueryS($body){
        $gqr = new Game();
	//\zqzlk\lib\Logger::console($body);
        $res = $gqr->queryContent($body);
        $this->assertTrue($res);
        return $gqr;
    }

    /**
     * @depends testGamesCaijiC
     */
    public function testGameQueryC($body){
        $gqr = new Game();
	//\zqzlk\lib\Logger::console($body);
        $res = $gqr->queryContent($body);
        $this->assertTrue($res);
        return $gqr;
	}
    /**
     * @depends testGameQueryS
     */
    public function testGameStorageS(Game $gqr){
        $gqr->setSeason('2016-2017');
        $res = $gqr->storeContent();
    }
}

<?php
namespace test;
use zqzlk\config\PregConfig;
use zqzlk\models\Game;
use PHPUnit_Framework_TestCase;
class ModelTest extends PHPUnit_Framework_TestCase{
	public function testCaiji(){
		$seasons = ['2016-2017','2015-2016'];
		$leagueId = 36;
		$isCup = false;
		$game = new Game();
		$game->caiji($seasons,$leagueId,$isCup);
	}
}
?>

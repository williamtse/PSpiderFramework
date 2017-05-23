<?php
namespace test;
use zqzlk\config\PregConfig;
use PHPUnit_Framework_TestCase;
class PregTest extends PHPUnit_Framework_TestCase{
	public function testCupKindPreg(){
		$preg = PregConfig::$arrCupKind;
		$content = "var arrCupKind = [[13365, 0, '赛事', '赛事', 'Match', 0, 1, 0]];";
		$res = preg_match($preg,$content,$match);
		var_dump($match);
		$this->assertTrue($res>0);
	}
}
?>
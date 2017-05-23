<?php
namespace test;
use PHPUnit_Framework_TestCase;

class LengthTest extends PHPUnit_Framework_TestCase{
	public function testNameEn(){
		$name_en = 'North and Central American Olympics Qualifiers';
		$this->assertTrue(strlen($name_en)<60);
	}
} 

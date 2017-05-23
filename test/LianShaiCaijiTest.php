<?php
namespace test;
use PHPUnit_Framework_TestCase;
use zqzlk\caijis\LianShai;

/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 23:18
 */
class LianShaiCaijiTest extends PHPUnit_Framework_TestCase
{
    public function testLianShaiCaiji(){
        $ls = new LianShai();
        $ls->init();
        $statusCode = $ls->getContent();
        $this->assertEquals(200,$statusCode);
        return $ls->getBody();
    }

    /**
     * @depends testLianShaiCaiji
     */
    public function testLianShaiQuery($contents){
        $ls = new \zqzlk\storages\LianShai();
        $res = $ls->queryContent($contents);
        $this->assertTrue($res);
        return $ls;
    }

    /**
     * @depends testLianShaiQuery
     */
    public function testStoreLianShai($ls){
        $ls->storeContent();
    }



}
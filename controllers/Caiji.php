<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 17:24
 */

namespace zqzlk\controllers;
use zqzlk\caijis\Games;
use zqzlk\caijis\LianShai;
use zqzlk\caijis\Seasons;
use zqzlk\lib\Logger;
use zqzlk\models\League;
use zqzlk\storages\Game;
use zqzlk\storages\Season;

class Caiji
{
    public function lianShai(){
        $ls = new LianShai();
        $ls->init();
        $statusCode = $ls->getContent();
        if($statusCode==200){
            $body =  $ls->getBody();
            $ls = new \zqzlk\storages\LianShai();
            $res = $ls->queryContent($body);
            if($res){
                $ls->storeContent();
            }
        }else{
            Logger::error("HTTP:$statusCode URL:".$ls->getUrl());
        }
    }

    public function games(){
        Logger::console("开始采集比赛");
        Logger::console("从数据库中查询所有足球联赛");
        $lgs = League::find(['Sport'=>'ft'])->all();
        foreach ($lgs as $lg){
            Logger::console("开始采集'{$lg['Name']}'的赛事");
            $seasonCaiji = new Seasons();
            $seasonCaiji->init(['LeagueId'=>$lg['LeagueId']]);
            if($seasonCaiji->getContent()==200){
                $seasonBody = $seasonCaiji->getBody();
                $sm = new Season();
				$ltype = intval($lg['Type']);
				$isCup = $ltype==2;
				$leagueId = $lg['LeagueId'];
                if($sm->queryContent($seasonBody)){
                    $seasonQueryDatas = $sm->datas;
					//采集最新的那个赛季
			        $gameModel = new \zqzlk\models\Game();
					$gameModel->caiji($seasonQueryDatas,$leagueId,$isCup);
                }
            }else{
                Logger::console("Http Error:$status Url:".$seasonCaiji->getUrl());
            }
        }
		
    }

}

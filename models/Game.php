<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 16:11
 */

namespace zqzlk\models;


use zqzlk\lib\ActiveRecord;
use zqzlk\caijis\Games;
use zqzlk\lib\Logger;



class Game extends ActiveRecord
{

	public function tableName()
    {
        $this->_table = 'zlk_ft_games';
    }

    public function caiji($seasons,$leagueId,$isCup,$idx=0){
		$season=$seasons[$idx];
        $gameCaiji = new Games();
		
        $gameCaiji->init([
            'Season'=>$season,
            'LeagueId'=>$leagueId,
            'type'=>$isCup
        ]);
        $status = $gameCaiji->getContent();
        if($status==200){
			$contents = $gameCaiji->getBody();
			if(strpos($contents,'你查看的页面不存在')){
				Logger::console("你查看的页面不存在 ".$gameCaiji->getUrl());
				$idx++;
				if(isset($seasons[$idx])){
					$this->caiji($seasons,$leagueId,$isCup,$idx);
				}else{
					return false;
				}
				
			}
			//如果是杯赛，保存杯赛的轮次信息
			if($isCup){
				$cupKindStorage = new \zqzlk\storages\CupKindStorage();
				if($cupKindStorage->queryContent($contents)){
					$cupKindStorage->setSeason($season);
					$cupKindStorage->setLeagueId($leagueId);
					$cupKindStorage->storeContent();
				}else{
					Logger::console("解析杯赛轮次信息失败");
					return false;
				}
				$cupDatasArr = $cupKindStorage->datasArr;
			}else{
				$cupDatasArr = [];
			}
			
			//保存球队
			Logger::console("保存球队信息");
			$team = new \zqzlk\storages\TeamStorage();
			Logger::console("_isCup:".($isCup?'Y':'N'));
			$team->setIsCup($isCup);
			if($team->queryContent($contents)){
				$team->setSeason($season);
				$team->setLeagueId($leagueId);
				$team->storeContent();
			}else{
				Logger::console("解析球队信息失败");
				return false;
			}
			//保存比赛use zqzlk\storages\Game;
            $gameQuery = new \zqzlk\storages\Game();
            $resGameQuery = $gameQuery->queryContent($contents);
            if($resGameQuery){
                $gameQuery->setSeason($season);
				$gameQuery->setLeagueId($leagueId);
				if($isCup){
					$gameQuery->setCupKind($cupDatasArr);
				}
				
                $gameQuery->storeContent();
            }else{
                $msg = '比赛信息匹配失败:'.$gameCaiji->getUrl();
                Logger::error($msg);
            }
        }else{
            Logger::console("Http Error:$status Url:".$gameCaiji->getUrl());
        }
	}
}
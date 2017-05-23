<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 17:42
 */

namespace zqzlk\storages;


use zqzlk\config\JH;
use zqzlk\lib\Storage as Zlk;
use zqzlk\lib\Interfaces\StorageInterface;
use zqzlk\lib\Logger;
use zqzlk\lib\PregMatch;
use zqzlk\analysis\LeagueGameAnalyze;
use zqzlk\config\GroupScoreConfig;
use zqzlk\models\GroupScore;
use zqzlk\config\CupKindConfig;


class Game extends Zlk implements StorageInterface
{
	protected $cupKind;
	public function setCupKind($arr){
		$this->cupKind = $arr;
	}

    public function queryContent($content)
    {
        $matches = PregMatch::getMatches(JH::$preg,$content);
        if(!$matches){
            return false;
        }
        $this->datas = $matches;
        return true;
    }


	protected function saveGame($item,$turnId,$group=NULL){
	        $res = \zqzlk\models\Game::find([
	            'id'=>$item[JH::$gameId],
	        ])->one();
			$game = new \zqzlk\models\Game();
	        if($res){	
				$game->setIsNewRecord(false);
				$game->setUpdateCondition(['id'=>$item[JH::$gameId]]);
                Logger::console("更新比赛：{$item[JH::$gameId]}|{$game->Season}|第{$game->Turn}轮|{$item[JH::$datetime]}|{$item[JH::$hteamId]} vs {$item[JH::$gteamId]}");
			}else{
                Logger::console("保存比赛：{$item[JH::$gameId]}|{$game->Season}|第{$game->Turn}轮|{$item[JH::$datetime]}|{$item[JH::$hteamId]} vs {$item[JH::$gteamId]}");
            }
			$game->id = $item[JH::$gameId];
			$game->status = $item[JH::$status];
	        $game->hteam_id = $item[JH::$hteamId];
	        $game->cteam_id = $item[JH::$gteamId];
	        $game->league_id = $item[JH::$leagueId];
			$game->hrank = $item[JH::$hrank];
			$game->crank = $item[JH::$crank];
	        $game->Turn = $turnId;
	        $game->Season = $this->season;
	        $game->start_time = strtotime($item[JH::$datetime]);
			if($group){
				$game->Group = $group;
			}
	        if($game->save()===false)
				throw new \Exception($game->getErrors());
        // }
	}
	protected function saveGroupScore($item,$turnId,$group){

			$groupScore = new GroupScore();
			$teamId = $item[GroupScoreConfig::$teamId];
			$condition = ['Season'=>$this->season,'LeagueId'=>$this->leagueId,'Group'=>$group,'TeamId'=>$teamId];
			$res = GroupScore::find($condition)->one();
			if($res){
				$groupScore->setIsNewRecord(true);
				$groupScore->setUpdateCondition(['id'=>$res['id']]);
			}
			$groupScore->Season = $this->season;
			$groupScore->LeagueId = $this->leagueId;
			$groupScore->TurnId = $turnId;
			$groupScore->Group = $group;
			$groupScore->TeamId = $teamId;
			$groupScore->Rank = $item[GroupScoreConfig::$rank];
			$groupScore->Total = $item[GroupScoreConfig::$total];
			$groupScore->Win = $item[GroupScoreConfig::$win];
			$groupScore->Defeat = $item[GroupScoreConfig::$defeat];
			$groupScore->Gain = $item[GroupScoreConfig::$gain];
			$groupScore->Lose = $item[GroupScoreConfig::$lose];
			$groupScore->Clean = $item[GroupScoreConfig::$clean];
			$groupScore->Score = $item[GroupScoreConfig::$score];
			$groupScore->save();
		
	}
    public function storeContent()
    {
        if(!$this->season){
            Logger::error("赛季没有设置");
            return false;
        }
		$gtypes = $this->datas[1];
		$lids = $this->datas[2];
		$groups = $this->datas[3];
		$datas = $this->datas[4];
		foreach($gtypes as $idx=>$gtype){
			$lid = $lids[$idx];
			Logger::console($gtype.$lids[$idx].$groups[$idx]);
			$data = $this->js2array($datas[$idx]);
			switch($gtype){
				case 'R_':
				foreach($data as $item){
					$this->saveGame($item,$lid);
				}
					
				break;
				case 'G'://杯赛
				$makeItTow = $this->cupKind[$lid][CupKindConfig::$makeItTow];
				if(!$makeItTow){
					foreach($data as $item){
						$this->saveGame($item,$lid);
						$this->saveGame($item,$lid);
					}
				}else{
					//第几圈的情况，数组结构不同
					foreach($data as $item){
						if(isset($item[5])){
							$this->saveGame($item[5],$lid,$groups[$idx]);
						}
						if(isset($item[4])){
							$this->saveGame($item[4],$lid,$groups[$idx]);
						}
						
					}
					
				}
				break;
				case 'S'://分组赛积分榜
				$group = $groups[$idx];
				foreach($data as $item){
					$this->saveGroupScore($item,$lid,$group);
				}
				
				break;
			}
		}
        
    }

    protected function js2array($str){
        $data = str_replace([',,',"',,"],[",'',","','',"],$str);
        eval("\$item=[$data];");
        return $item;
    }
}

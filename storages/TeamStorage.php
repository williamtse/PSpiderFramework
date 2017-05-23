<?php
	
namespace zqzlk\storages;

use zqzlk\lib\PregMatch;
use zqzlk\lib\Storage as Zlk;
use zqzlk\config\PregConfig;
use zqzlk\models\Team;
use zqzlk\config\TeamConfig;
use zqzlk\lib\Logger;

class TeamStorage extends Zlk
{
	
    public function queryContent($content)
    {

        $match = PregMatch::getMatch(PregConfig::$arrTeam,$content);

		if($match){
			$this->datas = $match[1];
			return true;
		}
        return false;
    }

    public function storeContent()
    {
        if(!$this->season){
            throw new Exception("赛季没有设置");
		}
		if(!$this->leagueId){
			throw new Exception("没有设置联赛id");
		}

		$data = $this->datas;
        $data = str_replace([',,',"',,"],[",'',","','',"],$data);
        eval("\$items=[$data];");
        foreach ($items[0] as  $item){
			//var_dump($item);
			$team = new Team();
			$res = Team::find(['Sport'=>'ft','TeamId'=>$item[TeamConfig::$teamId]])->one();
			if($res){
				$team->setIsNewRecord(false);
				$team->setUpdateCondition(['id'=>$res['id']]);
				Logger::console("更新球队：{$item[TeamConfig::$name_zh]}");
			}else{
				Logger::console("新建球队：{$item[TeamConfig::$name_zh]}");
			}
			$team->Sport = 'ft';
			$team->TeamId = $item[TeamConfig::$teamId];
			$team->Name_zh = $item[TeamConfig::$name_zh];
			$team->Name_tw = $item[TeamConfig::$name_tw];
			$team->Name_en = $item[TeamConfig::$name_en];
			if(isset($item[TeamConfig::$img])){
				$team->Img = $item[TeamConfig::$img];
			}
			if($team->save()===false){
				Logger::console($item[TeamConfig::$name_zh]."保存失败");
					exit();
			}
		}
		return true;
    }

}
?>
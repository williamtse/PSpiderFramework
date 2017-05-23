<?php

namespace zqzlk\storages;



use zqzlk\lib\Storage as Zlk;

use zqzlk\lib\PregMatch;
use zqzlk\config\PregConfig; 
use zqzlk\models\CupKind;
use zqzlk\config\CupKindConfig;
/**
* 杯赛轮次类型
* 
*/
class CupKindStorage extends Zlk
{
    public function queryContent($content)
    {
		// var_dump(PregConfig::$arrCupKind);
        $matches = PregMatch::getMatch(PregConfig::$arrCupKind,$content);
		// var_dump($matches);
        if(!$matches){
            return false;
        }
        $this->datas = $matches[1];
        return true;
    }
	
    public function storeContent()
    {
        if(!$this->season){
            throw new Exception("赛季没有设置");
		}
		if(!$this->leagueId){
			throw new Exception("没有设置联赛id");
		}
        //foreach ($this->datas as $data){
			$data = $this->datas;
            $data = str_replace([',,',"',,"],[",'',","','',"],$data);
			// Logger::console($data);
            eval("\$items=[$data];");
			$datasArr = [];
            foreach ($items[0] as  $item){
				$datasArr[$item[CupKindConfig::$turnId]] = $item;
                $cupKind = new CupKind();
				$res = CupKind::find(['Season'=>$this->season,'LeagueId'=>$this->leagueId,'TurnId'=>$item[CupKindConfig::$turnId]])->one();
				if(!$res){
					$cupKind->TrunId = $item[CupKindConfig::$turnId];
					$cupKind->Season = $this->season;
					$cupKind->LeagueId = $this->leagueId;
				}else{
					$cupKind->setIsNewRecord(false);
					$cupKind->setUpdateCondition(['id'=>$res['id']]);
				}
				$cupKind->orderNum = $item[CupKindConfig::$orderNum];
				$cupKind->Name_zh = $item[CupKindConfig::$name_zh];
				$cupKind->Name_tw = $item[CupKindConfig::$name_tw];
				$cupKind->Name_en = $item[CupKindConfig::$name_en];
				$cupKind->GroupCount = $item[CupKindConfig::$groupCount];
				$cupKind->MakeItTow = $item[CupKindConfig::$makeItTow];
				$cupKind->save();
            }
			$this->datasArr = $datasArr;
			//}
		return true;
    }
}

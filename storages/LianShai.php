<?php
namespace zqzlk\storages;

use zqzlk\lib\Storage as Zlk;
use zqzlk\models\Area;
use zqzlk\models\Country;
use zqzlk\lib\Logger;
use zqzlk\models\League;

class LianShai extends Zlk
{
    public function queryContent($content)
    {
        $pattern = '/= \[([^;]*)\];/';
        if(preg_match_all($pattern,$content,$matches)){
            $this->datas = $matches[1];
            return true;
        }
        return false;
    }
    public function storeContent()
    {
        foreach ($this->datas as $areaId=>$countries){//一级分类
            eval("\$countries = [$countries];");
            $areaModel = new Area();
            $res = Area::find(['AreaId'=>$areaId,'Sport'=>'ft'])->one();
            $aname = Area::Name($areaId);
            if($res){
                $areaModel->setIsNewRecord(false);
                $areaModel->setUpdateCondition(['id'=>$res['id']]);
                Logger::console("更新地区$aname");
            }else{
                Logger::console("保存新地区$aname");
            }
            $areaModel->AreaId = $areaId;
            $areaModel->Sport = 'ft';
            $areaModel->Name = $aname;
            $areaModel->save();
            foreach($countries as $c){//二级分类
                $cname = $c[0];
                $cid = $c[3];
                $res = Country::find([
                    'CountryId'=>$cid,
                    'Sport'=>1,
                    'Name'=>$cname,
                    'AreaId'=>$areaId
                ])->one();
                $cm = new Country();
                if($res){
                    $cm->setIsNewRecord(false);
                    $cm->setUpdateCondition(['id'=>$res['id']]);
                    Logger::console("更新国家".$cname);
                }else{
                    Logger::console("保存新国家".$cname);
                }
                $cm->CountryId = $cid;
                $cm->Sport = 1;
                $cm->Name = $cname;
                $cm->AreaId = $areaId;
                $cm->save();

		if(!empty($c[5])){
                	$leagues = $c[5];
			$this->saveLeagues($cid,$leagues);
		}
		if(!empty($c[4])){
			$this->saveLeagues($cid,$c[4]);
		}
            }
        }
    }
	//保存联赛
	public function saveLeagues($cid,array $leagues){
        foreach($leagues as $l){//联赛
            $lid = $l[0];
            $lname = $l[1];
            $ltype = $l[4];
            $res = League::find(['Sport'=>'ft',
                'CountryId'=>$cid,
                'LeagueId'=>$lid])->one();
            $lm = new League();

            if($res){
                $lm->setIsNewRecord(false);
                $lm->setUpdateCondition(['id'=>$res['id']]);
                Logger::console("更新联赛$lname");
            }else{
                Logger::console("保存新联赛$lname");
            }
            $lm->Sport = 'ft';
            $lm->CountryId = $cid;
            $lm->Name = $lname;
            $lm->LeagueId = $lid;
            $lm->Type = $ltype;
            $lm->save();
        }
	}
}

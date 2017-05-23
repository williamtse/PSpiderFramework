<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 16:36
 */

namespace zqzlk\storages;

use zqzlk\lib\Storage as Zlk;

class Season extends Zlk
{
    public function queryContent($content)
    {
        $pattern = '/= \[([^;]*)\];/';
        if(preg_match($pattern,$content,$matches)){
            $match_seasons = $matches[1];
            $seasons = explode(',',str_replace("'",'',$match_seasons));
            $this->datas = $seasons;
            return true;
        }
        return false;
    }

    public function storeContent()
    {
        // TODO: Implement storeContent() method.
    }

}
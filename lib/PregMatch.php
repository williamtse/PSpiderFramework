<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 18:16
 */

namespace zqzlk\lib;


class PregMatch
{
    public static function getMatch($preg,$content){
        if(preg_match($preg,$content,$match)){
            return $match;
        }
        return false;
    }
    public static function getMatches($preg,$content){
        if(preg_match_all($preg,$content,$match)){
            return $match;
        }
        return false;
    }
}

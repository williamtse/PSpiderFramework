<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 17:20
 */

namespace zqzlk\lib;


class Router
{
    public static function run($argv){
        if(isset($argv[1])){
            $arr = explode('/',$argv[1]);
            if(isset($arr[1])){
                $ctrl = $arr[0];
                $act = $arr[1];
                $class = 'zqzlk\controllers\\'.$ctrl;
                if(!class_exists($class)) die("控制器$class 不存在\n");
                $controller = new $class;
                if(!is_callable(array($controller, $act))) die("$ctrl->$act 方法不存在\n");
                $controller->$act();
            }else{
                die("无效的路由$argv[1]\n");
            }
        }else{
            die("请输入路由\n");
        }
    }
}
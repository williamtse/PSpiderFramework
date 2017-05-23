<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/13
 * Time: 9:21
 */

namespace zqzlk\lib;


class Logger
{
    public static function error($msg){
        $error_log_file = __DIR__.'/../logs/error.log';
        file_put_contents($error_log_file,"["
            .date('Y-m-d H:i:s')."] ".$msg."\n",
            FILE_APPEND);
    }
    public static function runtime($msg){
        $error_log_file = __DIR__.'/../logs/runtime.log';
        file_put_contents($error_log_file,"["
            .date('Y-m-d H:i:s')."] ".$msg."\n",
            FILE_APPEND);
    }

    public static function console($msg){
        $line = "["
        .date('Y-m-d H:i:s')."] ".$msg."\n";
        echo $line;
    }
}
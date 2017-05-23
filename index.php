<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 22:19
 */

define('ZQZLK_ROOT',__DIR__);
define('ZQZLK_CONFIG',__DIR__.'/config');
define('ZQZLK_LIB',__DIR__.'/lib');
require 'vendor/autoload.php';
require ZQZLK_ROOT.'/autoload.php';
include_once ZQZLK_CONFIG.'/common.php';
\zqzlk\lib\Router::run($argv);

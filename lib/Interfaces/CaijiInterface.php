<?php
namespace zqzlk\lib\Interfaces;
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 23:03
 */

Interface CaijiInterface{
    /**
     * 初始化采集地址
     * @return mixed
     */
    public function init($configs=[]);
}
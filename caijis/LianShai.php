<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 23:01
 */

namespace zqzlk\caijis;

use zqzlk\lib\Caiji;
use zqzlk\lib\Interfaces\CaijiInterface;

class LianShai extends Caiji implements CaijiInterface
{
    protected $url;

    public function init($configs=[])
    {
        $this->url = 'http://zq.win007.com/jsData/leftData/leftData.js';
    }

}
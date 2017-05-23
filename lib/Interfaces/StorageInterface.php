<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 23:08
 */

namespace zqzlk\lib\Interfaces;


interface StorageInterface
{
    /**
     * @param $content
     * @return mixed
     */
    public function queryContent($content);
    public function storeContent();
}
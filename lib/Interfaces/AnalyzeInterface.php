<?php
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/14
 * Time: 13:42
 */

namespace zqzlk\lib\Interfaces;


/**
 * 解析页面接口
 * Class AnalyzeInterface
 * @package zqzlk\lib\Interfaces
 */
interface AnalyzeInterface
{
    /**
     * 设置需要解析的内容
     * @param $content
     * @return mixed
     */
    public function setContent($content);

    /**
     * 解析
     * @return mixed
     */
    public function doAnalyze();
}
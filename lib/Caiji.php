<?php
namespace zqzlk\lib;
use GuzzleHttp\Client;
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 22:21
 */
class Caiji
{
    protected $http;
    protected $body;
    protected $url;

    public function __construct()
    {
        $this->http = new Client();
    }
    public function getBody(){
        return $this->body;
    }

    public function getContent()
    {
        $res = $this->http->request('GET', $this->url);
        $statusCode = $res->getStatusCode();
        if($statusCode==200){
            $this->body = $res->getBody()->getContents();
        }
        return $statusCode;
    }

    public function getUrl(){
        return $this->url;
    }
}

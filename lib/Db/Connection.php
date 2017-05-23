<?php
namespace zqzlk\lib\Db;
use zqzlk\config\DbConfig;
use PDO;
/**
 * Created by PhpStorm.
 * User: xie1w
 * Date: 2017/5/12
 * Time: 22:28
 * @property PDO $db
 */
class Connection
{
    private static $_instance;
    public static $db;
    private function __construct()
    {

    }
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            $db_config = new DbConfig();
            $dsn = $db_config->dsn;
            $username = $db_config->username;
            $password = $db_config->password;
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$db_config->charset,
            );
            $dbh = new PDO($dsn, $username, $password, $options);
            self::$db = $dbh;
            self::$_instance = new self;
        }
        return self::$_instance;

    }

    public function __clone()
    {
        trigger_error('Clone is not allow!',E_USER_ERROR);
    }
}
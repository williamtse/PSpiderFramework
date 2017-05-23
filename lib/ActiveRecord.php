<?php
namespace zqzlk\lib;

use PDOException;

abstract class ActiveRecord extends Base
{
    protected $_table;
    protected $connection;
    protected static $_sql;
    protected static $_inputs=[];
    public $_attributes;
    protected $_updateCondition=NULL;
    protected $errors;
    protected $_isNewRecord=true;

    abstract function tableName();

    public function __construct()
    {
        $this->tableName();
        $connection = Db\Connection::getInstance();
        $this->connection = $connection::$db;
    }

    public static function find(array $conditions=[]){
        $where = '';
        if(!empty($conditions)){
            self::$_inputs = [];
            foreach ($conditions as $key=>$cond){
                $where.= " AND `$key`= ?";
                self::$_inputs[] = $cond;
            }
        }
        self::$_sql.= " WHERE 1 $where ";
        return new static;
    }

    public function orderBy($str){
        self::$_sql.=" ORDER BY $str ";
        return $this;
    }

    public function limit($str){
        self::$_sql.=" LIMIT $str";
        return $this;
    }

    public function query(){
        $tableName = $this->_table;
        $sql = "SELECT * FROM ".$tableName.self::$_sql;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(self::$_inputs);
        self::$_sql ="";
        return $stmt;
    }

    public function all(){
        $stmt = $this->query();
        return $stmt->fetchAll();
    }

    public function one(){
        $stmt = $this->query();
        return $stmt->fetch();
    }
    public function setIsNewRecord($yn=true){
        $this->_isNewRecord = $yn;
    }
    public function setUpdateCondition(array $condition){
        $this->_updateCondition = $condition;
    }

    public function save(){
        if(!$this->_table){
            $this->tableName();
        }
        $sets= [];
        $values = [];
        $updates = [];
        foreach ($this->_attributes as $name => $value) {
            $sets[] = "`$name`";
            $values[] = "'".addslashes($value)."'";
            $updates[] = "`$name`='".addslashes($value)."'";
        }
        if($this->_isNewRecord){
            $sql = "insert into ".$this->_table." (".implode(',',$sets).")values (".implode(',',$values).")";
        }else{
            $uwhere = [];
            foreach($this->_updateCondition as $uk=>$un){
                $uwhere[] = "`$uk`='$un'";
            }
            $sql = "UPDATE ".$this->_table." SET ".implode(',',$updates)." WHERE ".implode(' AND ',$uwhere);
        }
        try{
            $affected = $this->connection->exec($sql);
            if ($affected === false) {
                $err = $this->connection->errorInfo();
                $this->errors = $err[2];
                if ($err[0] === '00000' || $err[0] === '01000') {
                    return true;
                }else{
                    throw new PDOException($this->errors.' sql:"'.$sql.'"');
                }
            }

        }catch(PDOException $e) {
            // Note The Typecast To An Integer!
            throw new PDOException( $e->getMessage( ) , (int)$e->getCode( ) );
        }
        return $affected;
    }

    public function __get($name){
        if(isset($this->_attributes[$name])){
            return $this->_attributes[$name];
        }
    }

    public function __set($name, $value)
    {
        if(!isset($this->_attributes[$name])){
            $this->_attributes[$name] = $value;
        }
    }
    public function getErrors(){
        return $this->errors;

    }
}
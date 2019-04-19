<?php

namespace SP;


use SP\Contract\Db;

class DataBase implements Db
{
    private $connect;

    private static $instance;
    
    public function __construct()
    {
        $mysqlConf = config("database.mysql");
        $this->connect = \mysqli_connect($mysqlConf["host"],$mysqlConf["user"],$mysqlConf["pass"],$mysqlConf["db"]);

        if(!$this->connect) {
            throw new \Exception("数据库连接失败");
        }
        mysqli_query($this->connect,"SET fieldS".$mysqlConf["charset"]);
        return $this->connect;
    }

    private function __clone(){}

    public static function GetInstance()
    {
        if(!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function execute(string $sql)
    {
        
    }

}

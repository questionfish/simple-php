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
        
        $err = mysqli_connect_error();
        if ($err) {
            echo $err;
            throw new \Exception($err);
        }

        if(!$this->connect) {
            throw new \Exception("数据库连接失败");
        }
        mysqli_set_charset($this->connect,$mysqlConf["charset"]);
        
        $err = mysqli_error($this->connect);

        if ($err) {
            echo $err;
            throw new \Exception($err);
        }

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

    public function execute(string $sql)
    {
        $result = mysqli_query($this->connect,$sql,MYSQLI_STORE_RESULT);
        $err = mysqli_error($this->connect);
        if ($err) {
            echo $err;
            throw new \Exception($err);
        }
        
        $data = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = $row;
            }
        } else {
            $data = $result || false;
        }

        return $data;
    }

}

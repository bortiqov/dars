<?php

class Db {
    
    protected $host = "127.0.0.1";
    protected $dbname = "test";
    protected $user = "root";
    protected $pass = "root";
    private static $inctance;
    private $connect;



    public function __construct()
    {
        $this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
    }
    public static function getDb(){
         self::$inctance = new Db();
         return self::$inctance;
    }
    public function conn(){
        return $this->connect;
    }
}




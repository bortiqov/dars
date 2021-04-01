<?php

class Database
{
    private static $staticConnect = null;
    private $db;

    private $dbHost = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName = "progress";
    private $dbCharset = "utf8";

    private function __construct()
    {
        $this->db = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName};charset={$this->dbCharset}", $this->dbUsername, $this->dbPassword);
    }

    public function getStaticConnect()
    {
        if (!self::$staticConnect)
        {
            self::$staticConnect = new Database();
        }

        return self::$staticConnect;
    }

    public function Connection()
    {
        return $this->db;
    }
}

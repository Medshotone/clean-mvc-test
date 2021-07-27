<?php

namespace app\config;

use PDO;

class Db
{
    private $host = "localhost";
    private $dbName = "clean-mvc-test";
    private $user = "admin";
    private $pass = "password";
    private $charset;
    private $opt;
    private $dsn;
    private $connection;
    private static $database;

    private function __construct()
    {
        $this->charset = "utf8mb4";
        $this->dsn = "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}";
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->connection = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

    public function __clone()
    {
        throw new \Exception("Can't clone a singleton");
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * getInstance
     *
     * this method will return instance of the class
     */
    public static function getInstance()
    {
        if (null == self::$database) {
            self::$database = new Db();
        }
        return self::$database;
    }

    /**
     * @return PDO
     */
    public function getDbConnection()
    {
        return $this->connection;
    }
}

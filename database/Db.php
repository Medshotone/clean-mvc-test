<?php

namespace database;

use PDO;

class Db
{
    private $host;
    private $dbName;
    private $user;
    private $pass;
    private $charset;
    private $opt;
    private $dsn;
    private $connection;
    private static $database;

    private function __construct()
    {
        $this->host = DB_HOSTNAME;
        $this->dbName = DB_DATABASE;
        $this->user = DB_USERNAME;
        $this->pass = DB_PASSWORD;
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
        throw new \Exception("Cannot unserialize a singleton");
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

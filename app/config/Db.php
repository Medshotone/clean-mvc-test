<?php

namespace app\config;

use PDO;
use PDOException;

class Db
{
    private $configSettings = [
        'dbname' => 'testdb',
        'host' => '127.0.0.1',
        'user' => 'admin',
        'password' => '1',
    ];

    private $dbConnection;

    public function __construct()
    {
        $dsn = "mysql:dbname={$this->configSettings['dbname']}host={$this->configSettings['host']}";
        $user = $this->configSettings['user'];
        $password = $this->configSettings['password'];

        try {
            $this->dbConnection = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    public function getDbConnection()
    {
        return $this->dbConnection;
    }
}
<?php

namespace app\core;

use app\config\Db;

class Model
{
    protected $fillable = [];
    protected static $db;

    public function __construct()
    {
        $db = new Db();
        self::$db = $db->getDbConnection();
    }

    private function makeTableName()
    {
        // creating a table name
        $className = explode('\\', get_called_class());

        $tableName = strtolower(end($className) . 's');

        return $tableName;
    }

    public function create(array $data)
    {
        // creating a table name
        $tableName = $this->makeTableName();

        // getting table columns
        if ($this->fillable) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->fillable)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = implode(',', array_keys($data));
        $prepareValues = implode(',',array_map(function ($data){
            return ':'.$data;
        },array_keys($data)));

        // making a query
        $query = "INSERT INTO `{$tableName}` ({$keys}) VALUES ({$prepareValues})";

        // prepare query
        $statement = self::$db->prepare($query);

        // execute query, and return true or false
        return $statement->execute($data) ? true : false;
    }

    public function all(string $orderBy = 'id', string $order = 'desc')
    {
        // creating a table name
        $tableName = $this->makeTableName();
        $query = "SELECT * FROM `$tableName` ORDER BY $orderBy $order";

        // prepare query
        $result = self::$db->query($query, \PDO::FETCH_ASSOC)->fetchAll();

        // execute query, and return true or false
        return $result ?? false;
    }

    public function find(int $id)
    {
        // creating a table name
        $tableName = $this->makeTableName();
        $query = "SELECT * FROM `$tableName` WHERE `id` = $id";

        // prepare query
        $result = self::$db->query($query, \PDO::FETCH_ASSOC)->fetch();

        // execute query, and return true or false
        return $result ?? false;
    }

    public function delete(int $id)
    {
        $tableName = $this->makeTableName();
        $query = "DELETE FROM $tableName WHERE `id` = ?";

        $stmt = self::$db->prepare($query);

        return $stmt->execute([$id]) ? true : false;
    }

}

<?php

namespace app\core;

use app\config\Db;

class Model
{
    protected $fillable = [];
    protected static $dbConnection;

    public function __construct()
    {
        $db = Db::getInstance();
        self::$dbConnection = $db->getDbConnection();
    }

    /**
     * @return string
     */
    private function makeTableName()
    {
        // creating a table name
        $className = explode('\\', get_called_class());

        $tableName = strtolower(end($className) . 's');

        return $tableName;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $tableName = $this->makeTableName();

        if ($this->fillable) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->fillable)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = implode(',', array_keys($data));
        $prepareValues = implode(',', array_map(function ($data) {
            return ':' . $data;
        }, array_keys($data)));

        $query = "INSERT INTO `{$tableName}` ({$keys}) VALUES ({$prepareValues})";

        $statement = self::$dbConnection->prepare($query);

        return $statement->execute($data) ? true : false;
    }

    /**
     * @param string $orderBy
     * @param string $order
     * @return array|bool
     */
    public function all(string $orderBy = 'id', string $order = 'desc')
    {
        $tableName = $this->makeTableName();

        $query = "SELECT * FROM `$tableName` ORDER BY $orderBy $order";

        $result = self::$dbConnection->query($query, \PDO::FETCH_ASSOC)->fetchAll();

        return $result ?? false;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function find(int $id)
    {
        $tableName = $this->makeTableName();

        $query = "SELECT * FROM `{$tableName}` WHERE `id` = ?";

        $statement = self::$dbConnection->prepare($query);

        $statement->execute([$id]);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result ?? false;

    }

    /**
     * @param string $column
     * @param string $operator
     * @param $value
     * @return array|bool
     */
    public function where(string $column, string $operator, $value)
    {
        $tableName = $this->makeTableName();

        $query = "SELECT * FROM `{$tableName}` WHERE `{$column}` {$operator} :value";

        $statement = self::$dbConnection->prepare($query);

        $statement->execute(['value' => $value]);

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result ?? false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $tableName = $this->makeTableName();

        $query = "DELETE FROM {$tableName} WHERE `id` = ?";

        $stmt = self::$dbConnection->prepare($query);

        return $stmt->execute([$id]) ? true : false;
    }
}

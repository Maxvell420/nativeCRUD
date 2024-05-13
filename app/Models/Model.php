<?php

namespace App\Models;

use Core\Config\Database;
use PDOStatement;

abstract class Model
{
    protected string $table;
    protected \PDO $connection;
    private static $instance = null;

    protected function __construct()
    {
        $database = new Database('examplehost', 'exampleUser', 'examplePassword', 'exampleDatabase');
        $this->connection = $database->getConnection();
    }

    // Метод для получения экземпляра класса
    public static function getInstance()
    {
        // Проверяем, был ли создан экземпляр класса
        if (self::$instance === null) {

            self::$instance = new static();
        }

        return self::$instance;
    }
    /*
    * Использую подготовленные запросы которые формирую динамически из данных, которые уже были проверены сервисом
    */
    public function create(array $data)
    {
        $params = implode(", ", array_keys($data));
        $counter = count($data);
        $values = '';
        for ($i=0;$i<$counter;$i++){
            if ($counter-$i==1) {
                $values.='?';
            } else {
                $values.='?, ';
            }
        }
        $query = "INSERT INTO {$this->table} ($params) VALUES ($values)";
        $statement = $this->prepare($query);
        $statement->execute(array_values($data));
    }
    public function update(string|int $id, array $data)
    {
        $params = implode(" = ? , ", array_keys($data));
        $values = array_values($data);
        $query = "UPDATE {$this->table} SET $params =? WHERE id = $id";
        $statement = $this->prepare($query);
        $statement->execute($values);
    }
    public function find(array $data)
    {
        $params = implode("= ? AND ", array_keys($data));

        $query = "SELECT * FROM {$this->table} WHERE ($params) = ?";
        $statement = $this->prepare($query);
        $statement->execute(array_values($data));
        return $statement->fetch();
    }
    public function getConnection(): \PDO
    {
        return $this->connection;
    }
    protected function createTable(string $query)
    {
        //        Лишний запрос каждый раз?
        $statement = $this->prepare($query);
        $statement->execute();
    }

    /**
     * @return false|PDOStatement
     */
    protected function prepare(string $query)
    {
        return $this->connection->prepare($query);
    }
}
<?php

namespace Core\Config;

//Использую в качестве Базы данных mysql
use PDO;

class Database
{
    private $connection;
    public function __construct(string $host, string $user, string $password, string $database)
    {
        try {

            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $exception){
            echo $exception->getMessage();
            die();
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
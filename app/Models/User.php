<?php
namespace App\Models;

use PDO;
use Core\Config\Database;
class User extends Model
{
    public function __construct()
    {
        $this->table='users';
        $query = "CREATE TABLE IF NOT EXISTS $this->table (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(100),
                phone VARCHAR(20),
                password VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        parent::__construct();
        $this->createTable($query);
    }
}
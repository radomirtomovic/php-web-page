<?php


namespace App\Database;


use PDO;

class Connection
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO($this->getConnection(), $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }

    private function getConnection(): string
    {
        return 'mysql:host=' . $_ENV['DB_HOST'] .
            ';dbname=' . $_ENV['DB_NAME'] .
            ';port=' . $_ENV['DB_PORT'] .
            ';charset=' . $_ENV['DB_CHARSET'];
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}

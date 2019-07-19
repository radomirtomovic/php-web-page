<?php


namespace App\Database;


use PDO;

class Connection
{
    /**
     * @var null|PDO
     */
    private static $pdo = null;

    public function __construct()
    {
        self::getPDO();
    }

    public function execute(string $sql, array $data = [], bool $select = true)
    {
        $statement = self::$pdo->prepare($sql);
        if($statement->execute($data)) {
            return $select ? $statement->fetchAll() : true;
        }
        return false;
    }


    private static function getPDO():PDO
    {
        if (self::$pdo ===null)
        {
            self::$pdo = new PDO(self::getConnection(), $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        }
        return self::$pdo;
    }

    private static function getConnection(): string
    {
        return 'mysql:host=' . $_ENV['DB_HOST'] .
            ';dbname=' . $_ENV['DB_NAME'] .
            ';port=' . $_ENV['DB_PORT'] .
            ';charset=' . $_ENV['DB_CHARSET'];
    }
}
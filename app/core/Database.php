<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    public $handler;
    private $statement;

    public function __construct()
    {
        $config = include(__DIR__ .  '/../../config/config.php');

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->handler = new PDO(
                $config['database']['local']['dsn'],
                $config['database']['local']['username'],
                $config['database']['local']['password'],
                $option
            );
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function query($query): void
    {
        $this->statement = $this->handler->prepare($query);
    }

    public function bind($param, $value, $type = NULL): void
    {
        if (is_null($type)) {
            switch (true) {
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute(): bool
    {
        return $this->statement->execute();
    }

    public function fetch(): mixed
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll(): array
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

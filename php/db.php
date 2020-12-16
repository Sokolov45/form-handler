<?php

class Db
{

    private $instance;
    private $pdo;
    private $log = [];


    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Одиночки не должны быть восстанавливаемыми из строк.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        $dbh = new PDO("mysql:host= HOST;dbname= DB_NAME", USER, PASS);
        $query = SELECT * FROM
    }


}
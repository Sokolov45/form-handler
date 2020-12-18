<?php

class Db
{

    private static $instance;
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
        $host = DB_HOST;
        $dbName = DB_NAME;
        $sbUser= DB_USER;
        $dbPassword = DB_PASS;
        if  (!$this->pdo) {
         $this->pdo = new PDO("mysql:host=$host ;dbname=$dbName DB_NAME", $sbUser, $dbPassword);
        }
        return $this->pdo;
    }

//    получить все записи по запросу
    public function fetchAll()
    {

    }
}
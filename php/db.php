<?php

class Db
{

    private static $instance;

    /**var \PDO*/
    private $pdo;

    private $log = [];

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    public static function getInstance():self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getConnection()
    {
        if (!isset($this->pdo)) {
            $driver = DB_DRIVER;
            $host = DB_HOST;
            $dbName = DB_NAME;
            $dbUser = DB_USER;
            $dbPassword = DB_PASSWORD;
            try {
                $this->pdo = new PDO("$driver:host=$host;dbname=$dbName", $dbUser, $dbPassword);
                // Определяем ошибки как исключения
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo "Подключение к базе не удалось: " . $e->getMessage();
            }
        }
        return $this->pdo;
    }

    public function fetchAll(string $query, $method, array $parametres = [])
    {
        $startTime = microtime(true);

        /*тут нужно заюзать prepare и execute, а это методы PDO, соответственно и сразу делаю через getConnectinon
        потому что он сделан через private*/
        $prepare = $this->getConnection()->prepare($query);
        $res = $prepare->execute($parametres);
        if ($res) {
            $return = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        }

        $time = microtime(true) - $startTime;

        $this->log[] = ["запрос - $query", "Вызван из метода - $method"];

        return $return;
    }

    public function fetchOne(string $query, $method, array $parametres = [])
    {
        $startTime = microtime(true);

        /*тут нужно заюзать prepare и execute, а это методы PDO, соответственно и сразу делаю через getConnectinon
        потому что он сделан через private*/
        $prepare = $this->getConnection()->prepare($query);
        $res = $prepare->execute($parametres);
        if ($res) {
            $return = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        }

        $time = microtime(true) - $startTime;

        $this->log[] = ["запрос - $query", "Вызван из метода - $method"];

        return reset($return);
    }

    public function exec($query, $method, $parametres)
    {
        $startTime = microtime(true);

        /*тут нужно заюзать prepare и execute, а это методы PDO, соответственно и сразу делаю через getConnectinon
        потому что он сделан через private*/
        $prepare = $this->getConnection()->prepare($query);
        $res = $prepare->execute($parametres);
        if ($res) {

        $time = microtime(true) - $startTime;

        $this->log[] = ["запрос - $query", $time, "Вызван из метода - $method"];

        return $this->lastInsertId();
        }

    }

    public function getLogs()
    {

    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}
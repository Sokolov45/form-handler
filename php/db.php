<?php

class Db
{
    private static $instance;
    private $pdo;
    private $log = [];

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __construct()
    {
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
        self::$instance = new Db();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        $host = HOST;
        $name = DB_NAME;
        $user = DB_USER;
        $password = DB_PASSWORD;

        if (!isset($this->pdo)) {
            try {
                $pdo_connection = new PDO("mysql:host=$host;dbname=$name", $user, $password);
                // Определяем ошибки как исключения
                $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Подключение прошло успешно!";
            }
            // Отлавливаем исключение
            catch(PDOException $e) {
                echo "Подключение не удалось: " . $e->getMessage();
            }
        }
        return $this->pdo;
    }

    public function fetchAll($query, $method, $parametres = [])
    {
        $start = microtime(true);
        $this->getConnection();
        $prepared = $this->pdo->prepare($query);
        $res = $prepared->execute($parametres);
        if ($res) {
            $data = $prepared->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

        //        логирование запроса
        $end = round(microtime(true) - $start, 4);
        $this->log[] = [
            'Время выполнения скрипта:' => $end,
            'Вызан из метода' => $method
        ];

        return $data;
    }

    public function fetchOne($query, $method, $parametres = [])
    {
        $start = microtime(true);
        $this->getConnection();
        var_dump($this->pdo);
        $prepared = $this->pdo->prepare($query);
        $res = $prepared->execute($parametres);
        if ($res) {
            $data = $prepared->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

//        логирование запроса
        $end = round(microtime(true) - $start, 4);
        $this->log[] = [
            'Время выполнения скрипта:' => $end,
            'Вызан из метода' => $method
        ];

        return reset($data);
    }

    public function exec()
    {

    }

    public function lasrInsertId()
    {

    }

}
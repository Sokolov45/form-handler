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
        if (!isset($instance)) {
            $instance = new Db();
        }
        return $instance;
    }

    public function fetchAll($query, __METHOD__, $parametres = [])
    {

    }

}
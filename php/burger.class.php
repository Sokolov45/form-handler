<?php


class Burger
{

    public function getUserByEmail($email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        $db->fetchOne($query, __METHOD__, [':email' => $email] );
    }

    public function createUser($email, $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users (name, email) VALUES(:name, :email)";
        $db->exec($query, __METHOD__, [':name' => $name, ':email' => $email] );
    }
}
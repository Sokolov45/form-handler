<?php

class Burger
{
    public function getUserByEmail($email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        $parametres = [':email' => $email];
        return $db->fetchOne($query, __METHOD__, $parametres);
    }

    public function createUser($email, $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users (name, email) VALUES(:name, :email)";
        $parametres = [
            ':name' => $name,
            ':email' => $email
            ];
        return $db->exec($query, $parametres);
    }


}
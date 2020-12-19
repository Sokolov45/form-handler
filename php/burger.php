<?php

class Burger
{
    public function getUserByEmail($email)
    {
//        создаю объект класса
        $db = Db::getInstance();

//        так будет выглядеть запрос
        $query = "SELECT * FROM users WHERE email = :email";
//        так опции для именованного плейсхолдера
        $opt = ['email' => $email];

        return $db->fetchOne($query, $opt);
    }

    public function incOrders()
    {

    }

    public function createUser($email, $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users(email, `name`) VALUES(:email, :name)";
        $opt = [':email' => $email, ':name' => $name];
        return $db->exec($query, $opt);
    }

    public function addOrder()
    {
        
    }
}
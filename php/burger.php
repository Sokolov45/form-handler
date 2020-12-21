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
        $opt = [':email' => $email];

        return $db->fetchOne($query, $opt);
    }

    public function incOrders($userId)
    {
        $db = Db::getInstance();
        $query = "UPDATE users SET orders_count=orders_count + 1 WHERE id = $userId";
        $db->exec($query);
    }

    public function createUser($email, $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users(email, `name`) VALUES(:email, :name)";
        $opt = [':email' => $email, ':name' => $name];
        return $db->exec($query, $opt);
    }

    public function addOrder($userId, $data)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orders(user_id, created_at, address) VALUES(:user_id, :created_at, :address)";
        $opt = [
            ':user_id' => $userId,
            ':created_at' => date("Y-m-d H:i:s"),
            ':address' => $data['address']
        ];
        $resualt = $db->exec($query, $opt);
        if (!$resualt) {
            return false;
        }
        return $db->lastInsertId();
    }
}
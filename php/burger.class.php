<?php


class Burger
{

    public function getUserByEmail(string $email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        return $db->fetchOne($query, __METHOD__, [':email' => $email] );
    }

    public function createUser($email, $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users (name, email) VALUES(:name, :email)";
        return $db->exec($query, __METHOD__, [':name' => $name, ':email' => $email] );
    }

    public function addOrder($userId, $address )
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orders (userId, address, created_at) VALUES(:userId, :address, :created_at)";
        $db->exec($query, __METHOD__, [
            ':userId' => $userId,
            ':address' => $address,
            ':created_at' => date("Y-m-d H:i:s")
        ]);
    }

    public function incOrders(int $userId)
    {
        $db = Db::getInstance();
        $query = "UPDATE users SET orders_count = orders_count + 1 WHERE id = :userId";
        $db->exec($query, __METHOD__, [':userId' => $userId]);
    }
}
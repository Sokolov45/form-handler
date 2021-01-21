<?php

class Burger
{

    public function getUserByEmail(string $email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        return $db->fetchOne($query, __METHOD__, [':email' => $email] );
    }

    public function createUser(string $email, string $name):int 
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users (email, name) VALUES(:email, :name)";
        return $db->exec($query, __METHOD__, [':email' => $email, ':name' => $name] );
    }

    public function addOrder(int $userId, string $address ):int
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orders (user_id, address, created_at) VALUES(:userId, :address, :created_at)";
        return $db->exec($query, __METHOD__, [
            ':userId' => $userId,
            ':address' => $address,
//            ':created_at' => date("Y-m-d H:i:s")
            ':created_at' => date('Y-m-d H:i:0')
        ]);
    }

    public function incOrders(int $userId)
    {
        $db = Db::getInstance();
        $query = "UPDATE users SET orders_count = orders_count + 1 WHERE id = :userId";
        $db->exec($query, __METHOD__, [':userId' => $userId]);
    }
}

//getUserByEmail как указать возвращаемый тип

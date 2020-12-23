<?php

class Burger
{
    public function getUserByEmail($email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM sokol WHERE email = :email";

    }
}
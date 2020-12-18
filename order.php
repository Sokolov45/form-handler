<?php

include 'php/config.php';
include 'php/burger.php';
include 'php/db.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

// header('Refresh: 5; url=http://localhost/sokol');

$email = $_POST['email'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = '';
$fields = ['street', 'home', 'korpus', 'flat', 'floor'];
foreach ($_POST as $key => $value) {
    if ($value && in_array($value, $fields)) {
        $address .=  $value . ',';
    }
}

$data = ['adress' => $address];

$burger = new Burger();
$user = $burger->getUserByEmail($email);
if ($user) {
    $userId = $user['id'];
    $burger->incOrders();
    $orders_number = $user['orders_count'] + 1;
//    должен вернуть id заказа
    //дату заказа запишем через sql

} else {
    //создаём юзера и должны вернуть его id
    $userId = $burger->createUser();
    $orders_number = 1;
}

    $burger->addOrder($userId);
echo "Спасибо, ваш заказ будет доставлен по адресу: “$address”
Номер вашего заказа: $orderId
Это ваш $orders_number -й заказ!";
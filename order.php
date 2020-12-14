<?php

include 'php/config.php';
include 'php/burger.php';
include 'php/db.php';

// header('Refresh: 5; url=http://localhost/sokol');

$email = $_POST['email'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = '';
$fields = ['street', 'home', 'korpus', 'flat', 'floor'];
foreach ($_POST as $key => $value) {
    if ($value && in_array($value, $fields)) {
        $address .= ',' . "$value";
    }
}

$burger = new Burger();
$user = $burger->getUserByEmail();
if ($user) {
    $userId = $user[id];
//    должен вернуть id заказа
    $orderId = $burger->addOrder($userId);

    $burger->incOrders();
    $orders_count = $user[orders_count] + 1;

    //дату заказа запишем через sql

} else {
    //создаём юзера и должны вернуть его id
    $userId = $burger->createUser();
    $burger->addOrder($userId);
}

echo "Спасибо, ваш заказ будет доставлен по адресу: “$address”
Номер вашего заказа: $orderId
Это ваш $orders_count -й заказ!";
<?php

include 'php/burger.php';
include 'php/config.php';
include 'php/db.php';

//ini_set();

$email = $_POST['email'];
$name = $_POST['user-name'];
//$fields = ['tel', 'street', 'home', 'korpus', 'flat', 'floor'];
//$address = [];
//foreach ($_POST as $item => $value) {
//    if ($value && in_array($item, $fields)) {
//        $address .= $value . ',';
//    }
//}
$burger = new Burger();
$user = $burger->getUserByEmail($email);

if ($user) {
//    $userId = $burger->incOrders($email);
    echo "user есть";
    
}else {
    $userId = $burger->createUser($email, $name);
    var_dump($userId);
}
die();

//дата id адресс
$burger->addOrder();

echo "Спасибо, ваш заказ будет доставлен по адресу: $address
Номер вашего заказа: $orderNumber
Это ваш $ordersCount -й заказ!";
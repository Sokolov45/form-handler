<?php

include 'php/config.php';
include 'php/burger.php';
include 'php/db.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

// header('Refresh: 5; url=http://localhost/sokol');

$email = $_POST['email'];
$name = $_POST['user-name'];
//$tel = $_POST['tel'];
$address = '';
$fields = ['street', 'home', 'korpus', 'flat', 'floor'];
foreach ($_POST as $key => $value) {
    if ($value && in_array($key, $fields)) {
        $address .=  $value . ',';
    }
}
$data = ['address' => $address];

$burger = new Burger();
$user = $burger->getUserByEmail($email);



if ($user) {
    $userId = $user['id'];
    $burger->incOrders($userId);
    $orders_number = $user['orders_count'] + 1;

} else {
    $userId = $burger->createUser($email, $name);
    $orders_number = 1;
}
var_dump($userId);
//echo "<pre>";
var_dump($data['address']);

$orderId = $burger->addOrder($userId, $data);

echo "Спасибо, ваш заказ будет доставлен по адресу: $address
Номер вашего заказа: $orderId
Это ваш $orders_number -й заказ!";



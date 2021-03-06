<?php

include 'php/config.php';
include 'php/db.class.php';
include 'php/burger.class.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE|E_ALL);

$name = $_POST['user-name'];
$email = $_POST['email'];
$address = '';
$fields = ["tel", 'street', 'home', 'korpus', 'flat', 'floor'];
foreach ($_POST as $item=>$value) {
    if ($value && in_array($item, $fields)) {
        $address .= $value . ',';
    }
}

$burger = new Burger();
$user = $burger->getUserByEmail($email);
if ($user) {
    $userId = $user['id'];
    $burger->incOrders($userId);
    $ordersCount = $user['orders_count'] + 1;

}else {
    $userId = $burger->createUser($email, $name);
    $ordersCount = 1;
}

$orderNumber = $burger->addOrder($userId, $address);

echo "Заказ по адруссу $address принят.<br>
    Номер вашего заказа $orderNumber.<br>
    Это ваш $ordersCount-й заказ";

echo "<hr>";
$db = Db::getInstance();
$db->getLogs();
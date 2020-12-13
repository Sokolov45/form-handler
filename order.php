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

$burger = new Burger();
$user = $burger->getUserbyEmail();
if ($user) {

} else {

}


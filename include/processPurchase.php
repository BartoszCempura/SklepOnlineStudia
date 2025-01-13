<?php
$userName = trim(filter_var($_POST['NameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
$userSurname = trim(filter_var($_POST['SurnameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
$phoneNumber = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$street = trim(filter_var($_POST['street'], FILTER_SANITIZE_SPECIAL_CHARS));
$streetNumber = trim(filter_var($_POST['streetNumber'], FILTER_SANITIZE_SPECIAL_CHARS));
$zip = trim(filter_var($_POST['zip'], FILTER_SANITIZE_SPECIAL_CHARS));
$city = trim(filter_var($_POST['city'], FILTER_SANITIZE_SPECIAL_CHARS));
$country = trim(filter_var($_POST['country'], FILTER_SANITIZE_SPECIAL_CHARS));

$user = getUser($client_conn, $_SESSION['login']);



//добавить запись в транзакции
//transaction_products
//Удалить cart_product и обнулить cart.Price

?>
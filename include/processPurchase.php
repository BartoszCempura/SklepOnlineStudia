<?php

require_once __DIR__ . '/global.php'; 

$userName = trim(filter_var($_POST['NameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
$userSurname = trim(filter_var($_POST['SurnameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
$phoneNumber = trim(filter_var($_POST['inputPhoneDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['inputEmailDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
$street = trim(filter_var($_POST['inputStreetDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
$streetNumber = trim(filter_var($_POST['inputStreetNumberDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
$zip = trim(filter_var($_POST['inputZipDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
$city = trim(filter_var($_POST['inputCityDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
$country = trim(filter_var($_POST['inputCountryDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));

$user = getUser($client_conn, $_SESSION['login']);



//добавить запись в транзакции
//transaction_products
//Удалить cart_product и обнулить cart.Price

?>
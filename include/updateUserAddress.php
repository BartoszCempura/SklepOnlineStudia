<?php
require_once __DIR__ . '/global.php';

$street = trim(filter_var($_POST['street'], FILTER_SANITIZE_SPECIAL_CHARS));
$streetNumber = trim(filter_var($_POST['streetNumber'], FILTER_SANITIZE_SPECIAL_CHARS));
$country = trim(filter_var($_POST['country'], FILTER_SANITIZE_SPECIAL_CHARS));
$city = trim(filter_var($_POST['city'], FILTER_SANITIZE_SPECIAL_CHARS));
$zip = trim(filter_var($_POST['zip'], FILTER_SANITIZE_SPECIAL_CHARS));
$type = 'shipping';
$userID = authorisedUser(); 

$addresses = getUserAddress($client_conn, $_SESSION['login']);

if(empty($addresses))
{
        $sql = "INSERT INTO clientdb.address (UserID, Street, Number, Country, City, Zip_Code, Type)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $client_conn->prepare($sql);
        $stmt->bind_param('issssss', $userID, $street, $streetNumber, $country, $city, $zip, $type);
}       
else
{
        $sql = "UPDATE clientdb.address
                JOIN clientdb.user ON clientdb.user.ID = clientdb.address.UserID
                SET UserID = ?, Street = ?, Number = ?, Country = ?, City = ?, Zip_Code = ?, Type = ?
                WHERE clientdb.user.ID = ? AND clientdb.address.Type = ?";
        $stmt = $client_conn->prepare($sql);
        $stmt->bind_param('issssssis', $userID, $street, $streetNumber, $country, $city, $zip, $type, $userID. $type);
}

$stmt->execute();

header("Location: /SklepOnlineStudia/index.php?page=ustawieniaDaneDoZamowien");
?>
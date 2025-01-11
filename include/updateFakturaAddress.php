<?php
require_once __DIR__ . '/global.php';

$street = trim(filter_var($_POST['street'], FILTER_SANITIZE_SPECIAL_CHARS));
$streetNumber = trim(filter_var($_POST['streetNumber'], FILTER_SANITIZE_SPECIAL_CHARS));
$country = trim(filter_var($_POST['country'], FILTER_SANITIZE_SPECIAL_CHARS));
$city = trim(filter_var($_POST['city'], FILTER_SANITIZE_SPECIAL_CHARS));
$zip = trim(filter_var($_POST['zip'], FILTER_SANITIZE_SPECIAL_CHARS));
$nip = trim(filter_var($_POST['nip'], FILTER_SANITIZE_SPECIAL_CHARS));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$type = 'billing';

$userID = authorisedUser(); 

$addresOfType = getUserAddressByType($client_conn, $_SESSION['login'], $type);


if(empty($addresOfType))
{
        $sql = "INSERT INTO clientdb.address (UserID, Street, Number, Country, City, Zip_Code, Nip, CompanyName, Type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $client_conn->prepare($sql);
        $stmt->bind_param('issssssss', $userID, $street, $streetNumber, $country, $city, $zip, $nip, $name, $type);
}       
else if($addresOfType > 0)
{
        $sql = "UPDATE clientdb.address
                JOIN clientdb.user ON clientdb.user.ID = clientdb.address.UserID
                SET UserID = ?, Street = ?, Number = ?, Country = ?, City = ?, Zip_Code = ?, Nip = ?, CompanyName = ?, Type = ?
                WHERE clientdb.user.ID = ? AND clientdb.address.Type = ?";
        $stmt = $client_conn->prepare($sql);
        $stmt->bind_param('issssssssis', $userID, $street, $streetNumber, $country, $city, $zip, $nip, $name, $type, $userID, $type);
}

$stmt->execute();

header("Location: /SklepOnlineStudia/index.php?page=ustawieniaDaneDoZamowien");
?>
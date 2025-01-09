<?php
require_once __DIR__ . '/global.php';

$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$phoneNumber = trim(filter_var($_POST['phoneNumber'], FILTER_SANITIZE_SPECIAL_CHARS));
$userID = authorisedUser(); 

$sql = "UPDATE clientdb.user
        SET First_Name = ?, Last_Name = ?, Phone_Number = ?
        WHERE clientdb.user.ID = ?";

$stmt = $client_conn->prepare($sql);
$stmt->bind_param('sssi', $name, $surname, $phoneNumber, $userID);
$stmt->execute();

header("Location: /SklepOnlineStudia/index.php?page=ustawieniaKonta");
?>
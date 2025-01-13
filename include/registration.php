<?php
require_once __DIR__ . '/global.php'; 

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password']));
$repeatPassword = trim(filter_var($_POST['repeatPassword']));
$email = trim(filter_var($_POST['email']));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$phoneNumber = trim(filter_var($_POST['phoneNumber'], FILTER_SANITIZE_SPECIAL_CHARS));

if(getUser($client_conn, $login))                        //CHECKS
{
    header("location: ../rejestracja?error=logintaken");
    exit();    
}

if(passwordsDontMatch($password,$repeatPassword))
{
    header("location: ../rejestracja?error=passwordsdontmatch");
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT); //PASSWORD HASHING


$sql = "INSERT INTO `User` (Login, Password, First_Name, Last_Name, Email, Phone_Number) VALUES (?, ?, ?, ?, ?, ?)";    //INSERT 
$query = $client_conn->prepare($sql);

$query->bind_param("ssssss", $login, $hashedPassword, $name, $surname, $email, $phoneNumber);

if($query->execute())
{
    $_SESSION['ID'] = $client_conn->insert_id;
    $id = $_SESSION['ID'];
    $addAddress = "INSERT INTO clientdb.Address VALUES ($id, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'shipping')"; // ADD client-connected address
    header("location: ../rejestracja?error=registrationnone");
}

exit();

?>
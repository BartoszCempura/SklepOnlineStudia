<?php
require_once __DIR__ . '/global.php'; 

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$repeatPassword = trim(filter_var($_POST['repeatPassword'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$phoneNumber = trim(filter_var($_POST['phoneNumber'], FILTER_SANITIZE_SPECIAL_CHARS));

if(loginTaken($client_conn, $login))                        //CHECKS
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
    header("location: ../rejestracja?error=registrationnone");
}

exit();

?>
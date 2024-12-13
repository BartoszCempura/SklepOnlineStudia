<?php

require_once('db.php');
require_once('functions.php');

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

//AUTH USER 

$sql = "SELECT * FROM `User` WHERE Login = ?";
$query = $client_conn->prepare($sql);
$query->bind_param('s', $login);
$query->execute();

$result = $query->get_result();
if ($row = $result->fetch_assoc()) 
{ 
    if (password_verify($password, $row['Password'])) {
        session_start();
        $_SESSION['ID'] = $row['ID'];
        header("Location: ../logowanie?error=loginnone");
        exit();
    } 
    else 
    {
        header("Location: ../logowanie?error=incorrectpassword");
        exit();
    }
}
else 
{
    header("Location: ../logowanie?error=usernotfound");
    exit();
}


?>
    

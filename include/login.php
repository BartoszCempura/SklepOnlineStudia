<?php

require_once __DIR__ . '/global.php';

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password']));

//AUTH USER 

loginUser($client_conn, $login, $password);

?>
    

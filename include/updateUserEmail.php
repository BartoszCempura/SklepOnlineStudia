<?php
require_once __DIR__ . '/global.php';

$newEmail = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
 
$user = getUser($client_conn, $_SESSION['login']);

if(password_verify($password, $user['Password']))
{
    $sql = "UPDATE clientdb.user
            SET Email = ?
            WHERE clientdb.user.ID = ?";

    $stmt = $client_conn->prepare($sql);
    $stmt->bind_param('si', $newEmail, $user['ID']);
    $stmt->execute();
    header("Location: /SklepOnlineStudia/index.php?page=ustawieniaKonta");
}
else
{
    header("Location: /SklepOnlineStudia/index.php?page=ustawieniaKonta&error=incorrectpassword");
}

?>
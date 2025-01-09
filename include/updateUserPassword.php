<?php
require_once __DIR__ . '/global.php';

$newPassword = trim(filter_var($_POST['Newpassword']));
$newPasswordConfirm = trim(filter_var($_POST['NewpasswordConfirm']));
$oldPassword = trim(filter_var($_POST['Oldpassword']));
 
$user = getUser($client_conn, $_SESSION['login']);

if(password_verify($oldPassword, $user['Password']))
{
    if($newPassword !== $newPasswordConfirm)
    {
        header("Location: /SklepOnlineStudia/index.php?page=ustawieniaKonta&error=passwordsdontmatch");
    }
    else
    {
        $sql = "UPDATE clientdb.user
                SET Password = ?
                WHERE clientdb.user.ID = ?";

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $client_conn->prepare($sql);
        $stmt->bind_param('si', $hashedPassword, $user['ID']);
        $stmt->execute();
        header("Location: /SklepOnlineStudia/index.php?page=ustawieniaKonta&error=changenone");
    }
}
else
{
    header("Location: /SklepOnlineStudia/index.php?page=ustawieniaKonta&error=incorrectpassword");
}

?>
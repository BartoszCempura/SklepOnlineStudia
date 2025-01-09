<?php
require_once __DIR__ . '/global.php';

$userID = authorisedUser();

if($userID === false)
{
    header("Location: ./");
}
else
{
    $sql = "DELETE FROM clientdb.user 
            WHERE clientdb.user.ID = ?";

    $stmt = $client_conn->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();

    header("Location: .\logout.php");
}
?>
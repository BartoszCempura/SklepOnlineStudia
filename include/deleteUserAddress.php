<?php
require_once __DIR__ . '/global.php';

$userID = authorisedUser();

if($userID === false)
{
    header("Location: ./");
}
else
{
    $sql = "DELETE clientdb.Address
            FROM clientdb.Address
            JOIN clientdb.user ON clientdb.user.ID = clientdb.Address.UserID 
            WHERE clientdb.user.ID = ? AND clientdb.Address.Type = ?";

    $type = 'shipping';

    $stmt = $client_conn->prepare($sql);
    $stmt->bind_param('is', $userID, $type);
    $stmt->execute();

    header("Location: ../ustawieniaDaneDoZamowien");
}
?>
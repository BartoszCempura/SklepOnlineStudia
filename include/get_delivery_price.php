<?php 

require_once __DIR__ . '/global.php';

if (isset($_POST['methodID'])) {
    // Odczytanie wartości methodID, którą wysłał JavaScript
    $methodID = (int)$_POST['methodID']; 

    // Pobranie danych o metodzie dostawy z bazy danych
    $deliveryData = getDeliveryMethodData($site_conn, $methodID);

    // Jeśli dane zostały poprawnie pobrane, zwrócimy cenę
    if ($deliveryData) {
        echo $deliveryData['price']; // Zwracamy tylko cenę (price)
    } else {
        echo "Błąd pobierania danych";
    }
} else {
    echo "ID metody nie zostało przekazane";
}

?>
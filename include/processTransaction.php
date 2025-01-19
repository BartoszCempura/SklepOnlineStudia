<?php
require_once __DIR__ . '/global.php';

if(isset($_SESSION['login']))
{
    if($_POST['isCompany'] === "0")
    {
        $userName = trim(filter_var($_POST['NameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
        $userSurname = trim(filter_var($_POST['SurnameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
        $addressType = "shipping";

        $companyName = "";
        $nip = "";
    }
    else if($_POST['isCompany'] === "1")
    {
        $companyName = trim(filter_var($_POST['NameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
        $nip = trim(filter_var($_POST['SurnameDeliveryBuy'], FILTER_SANITIZE_SPECIAL_CHARS));
        $addressType = "billing";

        $userName = "";
        $userSurname = "";
    }
    $phoneNumber = trim(filter_var($_POST['inputPhoneDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['inputEmailDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $street = trim(filter_var($_POST['inputStreetDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $streetNumber = trim(filter_var($_POST['inputStreetNumberDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $zip = trim(filter_var($_POST['inputZipDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $city = trim(filter_var($_POST['inputCityDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $country = trim(filter_var($_POST['inputCountryDelivery'], FILTER_SANITIZE_SPECIAL_CHARS));
    $deliveryMethodInput = $_POST['radioDelivery'];
    $paymentMethodID = $_POST['paymentRadio'];

    $user = getUser($client_conn, $_SESSION['login']);

    $userID = authorisedUser();
    $cart = getUserCart($client_conn, $userID);
    $cartID = $cart['ID'];
    $deliveryAddress = $paymentMethodID." ".$userID." ".$companyName." ".$nip." ".$street." ".$streetNumber." ".$country." ".$city." ".$zip." ".$addressType;
    $status = "Pending";
    $date = date("Y-m-d");
    $deliveryMethod = "$deliveryMethodInput";


    $sql = "INSERT INTO sitedb.transaction(CartID, UserID, DeliveryAddress, Status, Date, DeliveryMethod) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $site_conn->prepare($sql);
    $stmt->bind_param('iisssi', $cartID, $userID, $deliveryAddress, $status, $date, $deliveryMethod);
    $stmt->execute();

    header("Location: /SklepOnlineStudia/index.php?page=podsumowanie");
}

?>
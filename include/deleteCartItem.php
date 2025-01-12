<?php
require_once __DIR__ . '/global.php';

$userID = authorisedUser();
//$cartProducts = getUserCart_Product($client_conn, $site_conn, $userID);
$productID = trim(filter_var($_POST['productID'], FILTER_SANITIZE_SPECIAL_CHARS));
$price = trim(filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS));

$getCartIfExists = "SELECT * FROM clientdb.Cart WHERE clientdb.Cart.UserID = ?";
    $stmt2 = $client_conn->prepare($getCartIfExists);
    $stmt2->bind_param('i', $userID);
    $stmt2->execute();
    $cartResult = $stmt2->get_result();
    $cartData = $cartResult->fetch_assoc();

$sql = "DELETE FROM clientdb.Cart_Products
        WHERE clientdb.Cart_Products.CartID = ? AND clientdb.Cart_Products.ProductID = ?";

$stmt = $client_conn->prepare($sql);
    $stmt->bind_param('ii', $cartData['ID'], $productID);
    $stmt->execute();

$updateCartTotal = "UPDATE clientdb.Cart SET Total = Total - ? WHERE ID = ?";
    $stmt3 = $client_conn->prepare($updateCartTotal);
    $stmt3->bind_param('di', $price, $cartData['ID']);
    $stmt3->execute();

header("Location: ../koszyk");
?>


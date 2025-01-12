<?php 
require_once __DIR__ . '/global.php';

$productID = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
$productQuantity = trim(filter_var($_POST['NumberOfItemns'], FILTER_SANITIZE_SPECIAL_CHARS));

$getOldQuantity = "SELECT Quantity FROM clientdb.Cart_Products WHERE ProductID = ?";
$stmtOldQuantity = $client_conn->prepare($getOldQuantity);
$stmtOldQuantity->bind_param('i', $productID);
$stmtOldQuantity->execute();
$oldQuantityResult = $stmtOldQuantity->get_result();
$oldQuantity = $oldQuantityResult->fetch_assoc()['Quantity'];

$sql = "UPDATE clientdb.Cart_Products
        SET clientdb.Cart_Products.Quantity = ?
        WHERE clientdb.Cart_Products.ProductID = ?";
$stmt = $client_conn->prepare($sql);
$stmt->bind_param('ii', $productQuantity, $productID);
$stmt->execute();

$product = getProduct($site_conn, $productID);
$userID = authorisedUser();

$getCartIfExists = "SELECT * FROM clientdb.Cart WHERE clientdb.Cart.UserID = ?";
$stmt2 = $client_conn->prepare($getCartIfExists);
$stmt2->bind_param('i', $userID);
$stmt2->execute();
$cartResult = $stmt2->get_result();
$cart = $cartResult->fetch_assoc();

$quantityDifference = $productQuantity - $oldQuantity;
$priceDifference = $quantityDifference * $product['Price'];

$updateCartTotal = "UPDATE clientdb.Cart SET Total = Total + ? WHERE ID = ?";
$stmt5 = $client_conn->prepare($updateCartTotal);
$stmt5->bind_param('di', $priceDifference, $cart['ID']);
$stmt5->execute();

header("Location: /SklepOnlineStudia/index.php?page=koszyk");
exit;
?>

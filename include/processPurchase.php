<?php

require_once __DIR__ . '/global.php'; 

$transactionID = trim(filter_var($_POST['transactionID'], FILTER_SANITIZE_SPECIAL_CHARS));
$paymentMethodID = trim(filter_var($_POST['paymentMethodID'], FILTER_SANITIZE_SPECIAL_CHARS));
$total = trim(filter_var($_POST['total'], FILTER_SANITIZE_SPECIAL_CHARS));
$date = date("Y-m-d H:i:s");
$status = "Pending";
$userID = authorisedUser();
$cart = getUserCart($client_conn, $userID);

//change status of the transaction to "Completed";
$sql = "UPDATE sitedb.transaction
        SET Status = 'Completed'
        WHERE ID = ?";

$stmt = $site_conn->prepare($sql);
$stmt->bind_param('i', $transactionID);
$stmt->execute();

// insert into transaction_products the whole cart_product
$products = getUserCart_Product($client_conn, $site_conn, $userID);

foreach($products as $product)
{
    $productID = $product['ID'];
    $productQuantity = $product['Quantity'];
    $productPrice = $product['Price'];
    $insertTransactionProducts = "INSERT INTO sitedb.transaction_products(TransactionID, ProductID, Quantity, Price)
                                  VALUES (?, ?, ?, ?)";
    $stmt2 = $site_conn->prepare($insertTransactionProducts);
    $stmt2->bind_param('iiid', $transactionID, $productID, $productQuantity, $productPrice);
    $stmt2->execute();
}

// put payment data (transaction, total from podsumowanie, status = "Pending")
$paymentdataSql = "INSERT INTO sitedb.payment(TransactionID, Amount, Status, PaymentDate, PaymentMethod)
                   VALUES(?, ?, ?, ?, ?)";
$stmt3 = $site_conn->prepare($paymentdataSql);
$stmt3->bind_param('idssi', $transactionID, $total, $status, $date, $paymentMethodID);
$stmt3->execute();



// - the quantity of products in product table.
foreach($products as $product)
{
    $productQuantity = $product['Quantity'];
    $productID = $product['ID'];
    $extractProductQuantity = "UPDATE sitedb.Product
                               SET Quantity = Quantity - ?
                               WHERE Product.ID = ?";
    $stmt4 = $site_conn->prepare($extractProductQuantity);
    $stmt4->bind_param('ii', $productQuantity, $productID);
    $stmt4->execute();
}


// clear the user cart_product table.
foreach($products as $product)
{
    $productID = $product['ID'];
    $deletefromCart_Products = "DELETE FROM clientdb.Cart_Products
                                WHERE ProductID = ? AND CartID = ?";
    $stmt5 = $site_conn->prepare($deletefromCart_Products);
    $stmt5->bind_param('ii', $productID, $cart['ID']);
    $stmt5->execute();
}

// set cart total = 0
$cartTotal = "UPDATE clientdb.Cart
              SET Total = 0
              WHERE ID = ?";
$stmt6 = $site_conn->prepare($cartTotal);
$stmt6->bind_param('i', $cart['ID']);
$stmt6->execute();
?>
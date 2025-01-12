<?php
require_once __DIR__ . '/global.php';

if(!authorisedUser())
{
    header("Location: ../logowanie");
}

$productID = trim(filter_var($_POST['productID'], FILTER_SANITIZE_SPECIAL_CHARS));
$userID = trim(filter_var($_POST['userID'], FILTER_SANITIZE_SPECIAL_CHARS));

$cartProducts = getUserCart_Product($client_conn, $site_conn, $userID);

//Check if the product is already in cart
$productExists = false;
foreach ($cartProducts as $cartProduct) {
    if ($cartProduct['ID'] == $productID) {
        $productExists = true;
    }
}

if($productExists)
{
    if (isset($_SERVER['HTTP_REFERER'])) 
    {
        $referer_url = $_SERVER['HTTP_REFERER'];
        $parsed_url = parse_url($referer_url);

        if (isset($parsed_url['query'])) 
        {
            parse_str($parsed_url['query'], $query_params);

            if (isset($query_params['error'])) 
            {
                $query_params['error'] = 'incart';
            }
            else { $query_params['error'] = 'incart'; }

            $new_query = http_build_query($query_params);

            $new_url = $parsed_url['scheme'] . '://' . $parsed_url['host'];
            if (isset($parsed_url['path'])) {
                $new_url .= $parsed_url['path'];
            }
            if (!empty($new_query)) {
                $new_url .= '?' . $new_query;
            }
            if (isset($parsed_url['fragment'])) {
                $new_url .= '#' . $parsed_url['fragment'];
            }

            header("Location: $new_url");
            exit;
        }
    }
}

else 
{
    // Whole product data from sitedb
    $getProduct = "SELECT * FROM sitedb.Product WHERE sitedb.Product.ID = ?";
    $stmt = $site_conn->prepare($getProduct);
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $productResult = $stmt->get_result();
    $product = $productResult->fetch_assoc();

    if (!$product) {
        die("Nie ma produktu");
    }

    // Check if user's cart exists
    $getCartIfExists = "SELECT * FROM clientdb.Cart WHERE clientdb.Cart.UserID = ?";
    $stmt2 = $client_conn->prepare($getCartIfExists);
    $stmt2->bind_param('i', $userID);
    $stmt2->execute();
    $cartResult = $stmt2->get_result();

    if ($cartResult->num_rows === 0) // If cart doesnt exist -> create one
    {
        $total = 0;
        $createCart = "INSERT INTO clientdb.Cart (UserID, Total) VALUES (?, ?)";
        $stmt3 = $client_conn->prepare($createCart);
        $stmt3->bind_param('id', $userID, $total);
        $stmt3->execute();

        $cartID = $client_conn->insert_id; // get id from just-created cart row
    } else {
        // If cart exists -> get id from existing cart row
        $cart = $cartResult->fetch_assoc();
        $cartID = $cart['ID'];
    }

    // Add a product to user's cart 
    $putProductIntoCart = "INSERT INTO clientdb.Cart_Products (CartID, ProductID, Quantity, Price) VALUES (?, ?, ?, ?)";
    $stmt4 = $client_conn->prepare($putProductIntoCart);
    $quantity = 1; // products is added in quantity of 1 by default
    $price = $quantity * $product['Price'];
    $stmt4->bind_param('iiid', $cartID, $productID, $quantity, $price);
    $stmt4->execute();

    // update the total of the cart
    $updateCartTotal = "UPDATE clientdb.Cart SET Total = Total + ? WHERE ID = ?";
    $stmt5 = $client_conn->prepare($updateCartTotal);
    $stmt5->bind_param('di', $price, $cartID);
    $stmt5->execute();

    if (isset($_SERVER['HTTP_REFERER'])) 
    {
        $referer_url = $_SERVER['HTTP_REFERER'];
        $parsed_url = parse_url($referer_url);
    
        if (isset($parsed_url['query'])) 
        {
            parse_str($parsed_url['query'], $query_params);
    
            if (isset($query_params['error'])) 
            {
                $query_params['error'] = 'cartnone';
            }
            else { $query_params['error'] = 'cartnone'; }
    
            $new_query = http_build_query($query_params);
    
            $new_url = $parsed_url['scheme'] . '://' . $parsed_url['host'];
            if (isset($parsed_url['path'])) {
                $new_url .= $parsed_url['path'];
            }
            if (!empty($new_query)) {
                $new_url .= '?' . $new_query;
            }
            if (isset($parsed_url['fragment'])) {
                $new_url .= '#' . $parsed_url['fragment'];
            }
    
            header("Location: $new_url");
            exit;
        }
    }
}
?>

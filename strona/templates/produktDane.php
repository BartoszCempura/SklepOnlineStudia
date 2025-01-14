<?php
require_once dirname(dirname(__DIR__)) . '/include/global.php';

if (!empty($_GET['id'])) {
    $product = getProduct($site_conn, $_GET['id']);
    if ($product === 0) {
        echo '<div class="container-xl"><h2>Produkt którego szukasz nie był znaleziony.</h2></div>';
    } else {
        $id = $product['ID'];
        $image = $product['Image'];
        $name = $product['Name'];
        $price = $product['Price'];
        $description = $product['Description'];
        $quantity = $product['Quantity'];

        $userID = authorisedUser();
        $productID = $_GET['id'];
        
echo "<div class='container my-5 position-relative'>";
            raiseMessageAndRedirect("#");
    echo"<div class='card shadow-sm mb-3 rounded-0'>
        <div style='position: absolute; top: 20px; right: 20px; z-index: 10; display: flex; gap: 10px;'>
                <button type='button' class='btn btn-light me-2' style='width: 48px; height: 48px; display: flex; justify-content: center; align-items: center; color: #7b6dfa;'>
                    <i class='bi bi-heart fs-3'></i>
                </button>
                <form action='include/addProductToCart.php' method='POST' style='display: inline-block;'>
                    <input type='hidden' name='productID' value='$productID'>
                    <input type='hidden' name='userID' value='$userID'>
                    <button type='submit' class='btn custom-btn' style='width: 48px; height: 48px; display: flex; justify-content: center; align-items: center;'>
                        <i class='bi bi-cart fs-5'></i>
                    </button>
                </form>
            </div>
            <div class='row g-0 align-items-center'>
                <div class='col-md-4 d-flex justify-content-center align-items-center bg-white mx-5' style='flex-shrink: 0; width: 300px; height: 300px;'>
                    <img src='./images/$image' alt='$name' class='img-fluid rounded-0' style='object-fit: contain; max-width: 100%; max-height: 100%;'>
                </div>
                <div class='col-md-8'>
                    <div class='card-body w-50'>
                        <h4 class='card-title'>$name</h4>
                        <div class='border-bottom my-2'></div>
                        <h5 class='card-title'>Opis:</h5>                    
                        <p>$description</p>
                        <div class='border-bottom my-2'></div>
                        <h5 class=''>Dane techniczne:</h5>";
                        writeTechData($site_conn, $id);
                        echo "<div class='border-bottom my-2'></div>
                        <div class='d-flex align-items-center'>
                        <p class='me-2 fs-3'><strong>Cena:</strong></p>
                        <p class='p-0 fs-3' style='color: #7b6dfa;'><strong>$price zł</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
    }
}
?>
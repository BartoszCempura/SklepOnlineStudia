<?php
    require_once dirname(dirname(__DIR__)) . '/include/global.php';
    
    Repeat : 
    if(!empty($_GET['id']))
    {
        $product = getProduct($site_conn, $_GET['id']);
        if($product === 0)
        {
            unset($_GET);
            goto Repeat;
        }

        $id = $product['ID'];
        $image = $product['Image'];
        $name = $product['Name'];
        $price = $product['Price'];
        $description = $product['Description'];
        $quantity = $product['Quantity'];
    }
    else
    {
        echo '<div class="container-xl">
                <h2>Produkt którego szukasz nie był znaleziony.</h2>
              </div>';
    }
    ?>
    <?php
    
    raiseMessageAndRedirect("#");
    echo '<div class="container-fluid" style="height: 100vh; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center;">';
        $userID = authorisedUser();
        $productID = $_GET['id'];

        echo "
        <div class='card shadow-sm rounded-0' style='width: 80%; max-width: 1200px; padding: 20px; height: 90vh; display: flex; flex-direction: column; position: relative;'>
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

            <div class='row h-100'>
                <div class='col-md-6 d-flex justify-content-center align-items-center' style='border-right: 1px solid #dee2e6;'>
                    <img src='./images/$image' alt='nazwa-zdjecia' class='img-fluid rounded-0 shadow-sm' style='max-width: 90%; max-height: 90%; object-fit: contain;'>
                </div>

                <div class='col-md-6 d-flex flex-column justify-content-center px-4'>
                    <h3 class='mb-3' style='color:#7b6dfa;'>Cena: <b>$price zł</b></h3>
                    <h5 class='mb-4'>Dane techniczne:</h5>
                    <div class='mb-4'>";
        writeTechData($site_conn, $id);
        echo "</div>
            </div>";
    ?>







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
<div class="container-xl">              <!-- DO NAPRAWY --> 
    <?php
        echo "<div class='container-sm'></div>
                <img src='./images/$image' alt='nazwa-zdjecia'> <br>
                Cena: <b>$price zł</b> <br>
                Dane techniczne:";
        writeTechData($site_conn, $id);
        echo "<div class='d-flex'>
                <button type='#' class='btn btn-light me-2 rounded-0' style='width: 48px; height: 48px; display: flex; justify-content: center; align-items: center; color: #7b6dfa'>
                    <i class='bi bi-heart fs-3'></i>
                </button>
                <button type='#' class='btn custom-btn rounded-0' style='width: 48px; height: 48px; display: flex; justify-content: center; align-items: center;'>
                    <i class='bi bi-cart fs-5'></i>
                </button> 
            </div>";
        echo "</div>";
             

    ?>
    
</div>



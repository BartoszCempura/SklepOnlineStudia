<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

<title>Game Tech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        
        <link rel="stylesheet" href="strona/static/styles2.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
   <!-- <link rel="stylesheet" href="fontawesome-pro-5.15.3-web\fontawesome-pro-5.15.3-web\css\all.css"/> -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>   

  </head> 
<body>

<header class="container d-flex align-items-center justify-content-around w-50">
    

    <div>
        <a  id="home" href="home">
            <img src="strona/static/otherImages/GAME_TECH_LOGO.png" alt="Logo" width="90" height="80" class="d-inline-block align-top my-3">
        </a>
    </div>
    

    <div class="d-flex align-items-center justify-content-between position-relative d-none d-md-flex" style="width: 70%;">

        <div class="d-flex flex-column align-items-center mt-5">
            <a href="koszyk" class="btn custom-btn rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                <i class="bi bi-check-lg"></i>
            </a>
            <p class="mt-2">Koszyk</p> 
        </div>
        
 
        <div class="d-flex flex-column align-items-center mt-5 ms-4">
            <a href="DostawaPlatnosc" class="btn custom-btn rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                <i class="bi bi-check-lg"></i>
            </a>
            <p class="mt-2">Dostawa i Płatność</p> 
        </div>
        

        <div class="d-flex flex-column align-items-center mt-5">
            <button class="btn custom-linkbtn rounded-0 d-flex align-items-center justify-content-center p-1 bg-light text-decoration-none" style="height:40px; width:40px;">           
            <strong>3</strong>
            </button>
            <p class="mt-2">Podsumowanie</p> 
        </div>


        <div class="d-flex position-absolute w-100 ps-4 pe-5 z-n1">
            <div class="w-75" style="border: 3px solid #7b6dfa;"></div>
            <div class="w-75" style="border: 3px solid #7b6dfa;"></div>
        </div>
    </div>
</header>

<?php 
            require_once dirname(dirname(__DIR__)) . '/include/global.php';
            
            $userID = authorisedUser();

            $transactionData = getTransactionData($site_conn, $userID);

            $deliveryMethod = getDeliveryMethodData($site_conn, $transactionData['DeliveryMethod']);
            $userData = getUser($client_conn, $_SESSION['login']);
            $PhoneNumber = $userData['Phone_Number'];
            $Name = $userData['First_Name'];
            $Surname = $userData['Last_Name'];
            $Email = $userData['Email'];
            
            $words = preg_split('/\s+/', $transactionData['DeliveryAddress']); // pojedyncze slowa w łańcuchy address

            if(end($words) == "shipping")
            {
                $StreetDostawa = $words[2];
                $NumberDostawa = $words[3];
                $CountryDostawa = $words[4];
                $CityDostawa = $words[5];
                $Zip_CodeDostawa = $words[6];
                $isCompany = false;
            }
            else if(end($words) == "billing")
            {
                $Name = $words[2];
                $NipFaktura = $words[3];
                $StreetFaktura = $words[4];
                $NumberFaktura = $words[5];
                $CountryFaktura = $words[6];
                $CityFaktura = $words[7];
                $Zip_CodeFaktura = $words[8];
                $isCompany = true;
            }
            $paymentMethod = getPaymentMethodData($site_conn, $words[0]);

        ?>

<div class="container">
    <div class="row g-4">
        <!-- Column 1 (Dane osobowe odbiorcy przesyłki and Wybór dostawcy, Forma płatności) -->
        <div class="col-md-9">
            <div class="border shadow-sm p-3">
            <!-- Dane osobowe odbiorcy przesyłki -->
            <h4>Dane odbiorcy przesyłki</h4>
            <?php if ($isCompany): ?>
                <div class="position-relative">
                    <a href="DostawaPlatnosc" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none">Zmień</a>
                    <p id="companyBill" class="fw-bold mb-0">Nazwa Firmy</p>      
                    <p id="nameBill" class="fw-bold mb-0"><?php echo "$Name"?></p>             
                    <p class="mb-0">Adress: <?php echo "$StreetFaktura"." "."$NumberFaktura"; ?></p>
                    <p class="mb-0">Miasto: <?php echo "$Zip_CodeFaktura"." "."$CityFaktura"; ?></p>
                    <p class="mb-0">Kraj: <?php echo "$CountryFaktura"; ?></p>
                    <p class="mb-0">Nip: <?php echo "$NipFaktura"; ?></p>
                    <div class="d-flex">
                        <p class="mb-0">tel.</p>
                        <p class="mb-0 ms-2"><?php echo "$PhoneNumber"; ?></p>
                    </div>
                    <p class="mb-0"><?php echo "$Email"; ?></p> 
                </div>
            <?php else: ?>
                <div class="mb-3 position-relative">
                    <a href="DostawaPlatnosc" class="position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none">Zmień</a>
                    <p class="fw-bold mb-0"><?php echo "$Name" . " ". "$Surname"; ?></p>       
                    <p class="mb-0">Adress: <?php echo "$StreetDostawa"." "."$NumberDostawa"; ?></p>
                    <p class="mb-0">Miasto: <?php echo "$Zip_CodeDostawa"." "."$CityDostawa"; ?></p>
                    <p class="mb-0">Kraj: <?php echo "$CountryDostawa"; ?></p>
                    <div class="d-flex">
                        <p class="mb-0">tel.</p>
                        <p class="mb-0 ms-2"><?php echo "$PhoneNumber"; ?></p>
                    </div>
                    <p class="mb-0"><?php echo "$Email"; ?></p>
                </div>
            <?php endif; ?>
            <!-- Wybór dostawcy -->
            <div class="border-bottom"></div>
            <h4 class="my-3">Wybór dostawcy</h4>
            <div class="d-flex alignt-items-center justify-content-between">
                <div class="d-flex">
                    <p class="me-3"><?php $deliveryMethodData = getDeliveryMethodData($site_conn, $transactionData['DeliveryMethod']); echo $deliveryMethodData['name']?></p>
                    <a href="DostawaPlatnosc" class="text-decoration-none">Zmień</a>
                </div>
                <p><strong>cena: <?php echo $deliveryMethod['price'] ?></strong></p>
            </div>
            <!-- Forma płatności -->
            <div class="border-bottom"></div>
            <h4 class="mt-3">Wybrana forma płatności</h4>
            <div class="d-flex align-items-center justify-content-between mt-3">
                <div class="d-flex"> 
                    <img src="strona/static/otherImages/<?php echo $paymentMethod['image']?>" alt="" style="height: 20px;" class="mt-1 me-3">
                    <p class="me-3"><?php echo $paymentMethod['name']; ?></p>
                    <a href="DostawaPlatnosc" class="text-decoration-none">Zmień</a>
                </div>
                <p><strong>cena: <?php echo $paymentMethod['price']; ?></strong></p>
            </div>
            <div class="border-bottom"></div>
            <h4 class="my-3">Twoj koszyk 
                <?php
                    require_once __DIR__ . '/..//../include/global.php';
                    $userID = authorisedUser();
                    if(!empty($userID))
                    {
                        $products = getUserCart_Product($client_conn, $site_conn, $userID);
                        $total = 0;
                        $amountOfProducts = 0;
                        foreach($products as $product)
                        {
                            $price = $product['Price'];
                            $quantity = $product['Quantity'];
                            $total += ($price * $quantity);
                            $amountOfProducts += 1;
                        }
                    }
                    else { $amountOfProducts = 0; $total = 0; }
                    echo "(" . $amountOfProducts . ")";
                ?></h4>
            <div> 
                <?php
                if(!empty($userID))
                {
                    writeAllCartProducts($client_conn, $site_conn, $userID, true);
                }
                ?>        
            </div>
        </div>
    </div>
        <!-- Column 2 (Koszt produktów, Koszt dostawy, Do zapłaty, Dalej Button) -->
        <div class="col-md-3 border shadow-sm p-3" style="height: 300px;">
            <div class="d-flex justify-content-between">
                            <p class="mt-2 p-0">Koszt produktów:</p>
                            <p class="p-0 fs-4"><strong><?php echo $total?>zł</strong></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="mt-2 p-0">Koszt dostawy:</p>
                            <p class="p-0 fs-4"><strong><?php echo $deliveryMethod['price']; ?></strong></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="mt-2 p-0">Koszt płatności:</p>
                            <p class=" p-0 fs-4"><strong><?php echo $paymentMethod['price']; ?></strong></p>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="d-flex justify-content-between mt-3">
                            <p class="mt-2 p-0">Do zapłaty:</p>
                            <p class="p-0 fs-4"><strong><?php $totalAll = $total + $paymentMethod['price'] + $deliveryMethod['price']; echo $totalAll; ?> zł</strong></p>
                        </div>
                        <form action="include\processPurchase.php" id="formID" method="POST">
                            <input type="hidden" name="total" value="<?php echo $totalAll; ?>">
                            <input type="hidden" name="transactionID" value="<?php echo $transactionData['ID']; ?>">
                            <input type="hidden" name="paymentMethodID" value="<?php echo $paymentMethod['id']; ?>">
                        </form>
                        <button type="submit" form="formID" class="btn custom-btn rounded-0 w-100 mb-1 text-decoration-none">
                            Zapłać
                        </button>
            </div>

        
        <a href="DostawaPlatnosc" class="btn custom-btn rounded-0 my-5">Powrót do Dostawa i Płatność</a>
    </div>
</div>






<script src="strona/static/index4.js"></script>
</body>
</html>
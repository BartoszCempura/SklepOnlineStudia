<?php

    $address = getUserAddressByType($client_conn, $_SESSION['login'], "shipping");
    $addressFaktura = getUserAddressByType($client_conn, $_SESSION['login'], "billing");
    $userID = authorisedUser();
    $cart = getUserCart($client_conn, $userID);
    $total = $cart['Total'];

    $user = getUser($client_conn, $_SESSION['login']);
    $Name = $user['First_Name'];
    $Surname = $user['Last_Name'];
    $PhoneNumber = $user['Phone_Number'];
    $Email = $user['Email'];
    
    $adress = getUserAddress($client_conn, $_SESSION['login']);
    $CompanyName = $adress['CompanyName'] ?? "";
    $Nip = $adress['Nip'] ?? "";
    $Street = $adress['Street'] ?? "";
    $StreetNumber = $adress['Number'] ?? "";
    $Country = $adress['Country'] ?? "";
    $City = $adress['City'] ?? "";
    $ZipCode = $adress['Zip_Code'] ?? "";

?>


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
            <img src="strona/static/otherImages/GAME_TECH_LOGO.png" alt="Logo" width="90" height="80" class="d-inline-block align-top">
        </a>
    </div>
    

    <div class="d-flex align-items-center justify-content-between position-relative" style="width: 70%;">

        <div class="d-flex flex-column align-items-center mt-5">
            <a href="koszyk" class="btn custom-btn rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                <i class="bi bi-check-lg"></i>
            </a>
            <p class="mt-2">Koszyk</p> 
        </div>
        
 
        <div class="d-flex flex-column align-items-center mt-5 ms-4">
            <button class="btn custom-linkbtn rounded-0 d-flex align-items-center justify-content-center p-1 bg-light text-decoration-none" style="height:40px; width:40px;">
                <strong>2</strong>
            </button>
            <p class="mt-2">Dostawa i Płatność</p> 
        </div>
        

        <div class="d-flex flex-column align-items-center mt-5">
            <a href="podsumowanie" class="btn custom-btn rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                3
            </a>
            <p class="mt-2">Podsumowanie</p> 
        </div>


        <div class="d-flex position-absolute w-100 ps-4 pe-5 z-n1">
            <div class="w-75" style="border: 3px solid #7b6dfa;"></div>
            <div class="border border-3 border-secondary w-75"></div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row g-5">
            <div class="col-md-9">
                <div class="row mb-3">
                    <div class="col border shadow-sm p-3">
                        <h4 class="mb-3">Dane odbiorcy przesyłki</h4>
                        <p>Podaj adres gdzie mamy dostarczyc przesyłkę!</p>
                            <div class="form-check d-flex align-items-center mb-3">
                                <input class="form-check-input rounded-0 me-3" type="checkbox" id="gridCheckBuy" onchange="toggleCompanyCheckbox()"></input>
                                    <label class="form-check-label" for="gridCheckBuy">
                                        <small>Firma</small>
                                    </label>
                            </div>
                            
                            <form action="include/processTransaction.php" style="width:65%;" method="post" id="formID">

                            <input type="hidden" name="isCompany" id="isCompany" value="0">
                            <div class="row">
                                <div class="col-6" id="nameColumn">
                                    <input type="text" class="form-control rounded-0" id="NameDeliveryBuy" name="NameDeliveryBuy" data-max-length="50" value="<?php echo $Name; ?>" placeholder="Imie" required>
                                </div>
                                <div class="col-6" id="surnameColumn">
                                    <input type="text" class="form-control rounded-0" id="SurnameDeliveryBuy" name="SurnameDeliveryBuy" data-max-length="50" value="<?php echo $Surname; ?>" placeholder="Nazwisko" required>
                                </div>
                            </div>
                                <div class="row">
                                    <label  class="my-2" for="inputPhone">Numer telefonu</label>
                                    <div class="col-md-6">                               
                                        <input type="tel" pattern="([0-9]{3})([0-9]{3})([0-9]{3})" class="form-control rounded-0" id="inputPhoneDelivery" name="inputPhoneDelivery" value="<?php echo $PhoneNumber; ?>" placeholder="123456789" oninput="enforceDigits(event)" maxlenght="9" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control rounded-0" id="inputEmailDelivery" name="inputEmailDelivery" value="<?php echo $Email; ?>" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="my-2">Adres</p>
                                    <div class="col-9">
                                        <input type="text" class="form-control rounded-0" id="inputStreetDelivery" name="inputStreetDelivery" value="<?php echo $Street; ?>" placeholder="Ulica" pattern="[a-zA-Z]+" required>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" class="form-control rounded-0" id="inputStreetNumberDelivery" name="inputStreetNumberDelivery" value="<?php echo $StreetNumber; ?>" placeholder="" min="1" max="499" required>
                                    </div>
                                </div>
                                <div class="row w-75">
                                    <p class="my-2">Kod pocztowy</p>
                                    <div class="col-4">
                                        <input type="text" class="form-control rounded-0" id="inputZipDelivery" name="inputZipDelivery" value="<?php echo $ZipCode; ?>" placeholder="xx-xxx" pattern="([0-9]{2})-([0-9]{3})" maxlenght="6" required>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control rounded-0" id="inputCityDelivery" name="inputCityDelivery" value="<?php echo $City; ?>" placeholder="Miasto" pattern="[a-zA-Z]+" required>
                                    </div>
                                </div>
                                <input type="text" class="form-control rounded-0 my-3 w-50" id="inputCountryDelivery" name="inputCountryDelivery" value="<?php echo $Country; ?>" placeholder="Kraj" pattern="[a-zA-Z]+" required>
                            </form>



                    </div>
                </div>
                
                <!-- Second row inside the larger column -->
                <div class="row mb-3">
                    <div class="col border shadow-sm p-3 ">
                    <h4 class="mb-3">Wybór dostawcy</h4>
                        <p>Wybierz preferowaną formę dostawy!</p>
                        <div class="d-flex justify-content-between">
                            <div class="form-check d-flex align-items-center ">
                                <input class="form-check-input rounded-0 me-3" form="formID" type="radio" name="radioDelivery" value="2" id="gridCheckDeliveryExpress"></input>
                                    <label class="form-check-label" for="gridCheckDeliveryExpress">
                                        <small>Kurier express</small>
                                    </label>
                                    <i class="bi bi-info-square ms-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Dostawa zamwienia zostanie zrealizowana na terenie Polski za pośrednictwem jednej z firm kurierskich. Zamwienie dotrze do Ciebie w ciąguokoło 1 dnia roboczego od momentu wysyłki. Przewoźnicy, z ktrymi wspłpracujemy to m.in.: GLS (większość zawień), DPD, Geis (w przypadku większych gabarytw) orazZadbano i SUUS (w przypadku wniesienia i montażu produktw AGD i RTV)"></i>
                            </div>
                            <p class="mt-1"><strong>
                                        <?php 
                                            $deliveryData = getDeliveryMethodData($site_conn, 2); 
                                            echo $deliveryData['price'];
                                        ?> 
                                    zł
                                </strong></p>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="d-flex justify-content-between my-2">
                            <div class="form-check d-flex align-items-center ">
                                <input class="form-check-input rounded-0 me-3" form="formID" type="radio" name="radioDelivery" value="1" id="gridCheckDeliveryStandard" checked></input>
                                    <label class="form-check-label" for="gridCheckDeliveryStandard">
                                        <small>Kurier standard</small>
                                    </label>
                                    <i class="bi bi-info-square ms-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Dostawa zamwienia zostanie zrealizowana na terenie Polski. Zamwienie dotrze do Ciebie w ciągu około 2 dni roboczych od momentu wysyłki. Przewoźnicy z ktrymi wspłpracujemy to m.in.: GLS, DPD i Poczta Polska."></i>
                            </div>
                            <p  class="mt-1"><strong>
                                        <?php 
                                            $deliveryData = getDeliveryMethodData($site_conn, 1); 
                                            echo $deliveryData ['price'];
                                        ?> 
                                    zł
                                </strong></p>
                        </div>
                    </div>
                </div>
                
                <!-- Third row inside the larger column -->
                <div class="row">
                <div class="col border shadow-sm p-3 ">
                    <h4 class="mb-3">Wybierz formę płatności</h4>
                        <div class="d-flex justify-content-between">
                                <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input rounded-0 me-3" name="paymentRadio" value="1" form="formID" type="radio" id="gridCheckDeliveryExpress" checked></input>
                                    <img src="strona/static/otherImages/blik.svg" alt="" style="height: 20px;">
                                        <label class="form-check-label ms-3" for="gridCheckDeliveryExpress">
                                            <small>Blik</small>
                                        </label>
                                </div>
                                <p><strong>
                                        <?php 
                                        //
                                            $paymentData = getPaymentMethodData($site_conn, 1); 
                                            echo $paymentData['price'];
                                        ?> 
                                    zł
                                </strong></p>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center my-3">
                                    <input class="form-check-input rounded-0 me-3" name="paymentRadio" value="2" form="formID" type="radio" id="gridCheckDeliveryStandard"></input>
                                    <img src="strona/static/otherImages/googlepay.svg" alt="" style="height: 20px;">
                                        <label class="form-check-label ms-3" for="gridCheckDeliveryStandard">
                                            <small>Google Pay</small>
                                        </label>
                                </div>
                                <p class="pt-3"><strong>
                                        <?php 
                                            $paymentData = getPaymentMethodData($site_conn, 2); 
                                            echo $paymentData['price'];
                                        ?> 
                                    zł
                                </strong></p>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center my-3">
                                    <input class="form-check-input rounded-0 me-3" name="paymentRadio" value="3" form="formID" type="radio" id="gridCheckDeliveryStandard"></input>
                                    <img src="strona/static/otherImages/transfer.svg" alt="" style="height: 20px;">
                                        <label class="form-check-label ms-3" for="gridCheckDeliveryStandard">
                                            <small>Przelew tradycyjny</small>
                                        </label>
                                </div>
                                <p class="pt-3"><strong>
                                        <?php 
                                            $paymentData = getPaymentMethodData($site_conn, 3); 
                                            echo $paymentData['price'];
                                        ?> 
                                    zł
                                </strong></p>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="d-flex justify-content-between">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input rounded-0 me-3" name="paymentRadio" value="4" form="formID" type="radio" id="gridCheckDeliveryStandard"></input>
                                    <img src="strona/static/otherImages/mastercard.svg" alt="" style="height: 20px;">
                                        <label class="form-check-label ms-3" for="gridCheckDeliveryStandard">
                                            <small>Karta płatnicza online</small>
                                        </label>
                                        <i class="bi bi-info-square ms-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Bezpieczna płatność przez internet kartą kredytową lub debetową. Do realizacji transakcji wykorzystujemy system Przelewy24."></i>
                                </div>
                                <p class="pt-3"><strong>
                                        <?php 
                                            $paymentData = getPaymentMethodData($site_conn, 4); 
                                            echo $paymentData['price'];
                                        ?> 
                                    zł
                                </strong></p>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Smaller column (3 parts) -->
             
            <div class="col-md-3 border shadow-sm p-3" style="height: 300px;">
            <div class="d-flex justify-content-between">
                <p class="mt-2 p-0">Koszt produktów:</p>
                <p class="p-0 fs-4"><strong><?php echo $total; ?> zł</strong></p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="mt-2 p-0">Koszt dostawy:</p>
                <p class="p-0 fs-4"><strong id="deliveryPrice">
                    <?php 
                        $deliveryData = getDeliveryMethodData($site_conn, 1); //default
                        echo $deliveryData['price'] . " zł"; 
                    ?>
                </strong></p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="mt-2 p-0">Koszt płatności:</p>
                <p class="p-0 fs-4" ><strong id="paymentPrice">
                <?php 
                        $paymentData = getPaymentMethodData($site_conn, 1); 
                        echo $paymentData['price'] . " zł";
                ?> 
                </strong></p>
            </div>
            <div class="border-bottom"></div>
            <div class="d-flex justify-content-between mt-3">
                <p class="mt-2 p-0">Do zapłaty:</p>
                <p class="p-0 fs-4 "><strong class="total-price"><?php echo $total?> zł</strong></p>
            </div>

                <button form="formID" class="btn custom-btn rounded-0 w-100 mb-1 text-decoration-none">
                            Dalej
                </button>
            </div>  
            <a href="koszyk" class="btn custom-btn rounded-0 my-5">Powrót do koszyka</a>
</div> 
</div>

<script>
    // Funkcja do aktualizacji całkowitej ceny
function updateTotalPrice() {
    const productTotal = <?php echo $total; ?>; // Pobieramy początkową cenę produktów z PHP
    const total = productTotal + deliveryPrice + paymentPrice; // Obliczamy całkowitą cenę
    document.querySelector('.total-price').innerHTML = total.toFixed(2) + " zł"; // Aktualizujemy całkowitą cenę na stronie
}</script>

<script>
  // Initialize tooltips
  var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });
</script>

<script src="strona/static/DeliveryPayment.js"></script>
</body>
</html>

<h2 align="center" class="mt-4">Dane do zamówień</h2>
<div class="container mt-4 mb-4 border shadow p-3 w-25" style="caret-color: transparent;">
    <h4 class="mb-3">Adres dostawy</h4>
    
    <?php 
            require_once dirname(dirname(__DIR__)) . '/include/global.php';
            if(isset($_SESSION['login']))
            {
                $user = getUser($client_conn, $_SESSION['login']);
                $Name = $user['First_Name'];
                $Surname = $user['Last_Name'];
                $PhoneNumber = $user['Phone_Number'];
                $Email = $user['Email'];

                $faktura = getUserAddressByType($client_conn, $_SESSION['login'], 'billing');
                $dostawa = getUserAddressByType($client_conn, $_SESSION['login'], 'shipping');
                
                if(!empty($faktura))
                {
                    $StreetFaktura = $faktura['Street'];
                    $NumberFaktura = $faktura['Number'];
                    $CountryFaktura = $faktura['Country'];
                    $CityFaktura = $faktura['City'];
                    $Zip_CodeFaktura = $faktura['Zip_Code'];
                    $companyNameFaktura = $faktura['CompanyName'];
                    $NipFaktura = $faktura['Nip']; 
                }
                else
                {
                    $StreetFaktura = "";
                    $NumberFaktura = "";
                    $CountryFaktura = "";
                    $CityFaktura = "";
                    $Zip_CodeFaktura = "";
                    $companyNameFaktura = "";
                    $NipFaktura = "";
                }

                if(!empty($dostawa))
                {
                    $StreetDostawa = $dostawa['Street'];
                    $NumberDostawa = $dostawa['Number'];
                    $CountryDostawa = $dostawa['Country'];
                    $CityDostawa = $dostawa['City'];
                    $Zip_CodeDostawa = $dostawa['Zip_Code'];
                }
                else
                {
                    $StreetDostawa = "";
                    $NumberDostawa = "";
                    $CountryDostawa = "";
                    $CityDostawa = "";
                    $Zip_CodeDostawa = "";
                }
            }
            else
            {
                // OSTAVIT' |
                //          v
                $companyName = "";
                $Nip = "";
                $Street = "";
                $Number = "";
                $Country = "";
                $City = "";
                $Zip_Code = "";

                $PhoneNumber = "Brak";
                $Email = "Brak";
                $Name = "Brak";
                $Surname = "Brak";
            }
        ?>

    <div class="border p-3 position-relative mb-3">
        <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal1">Edytuj</button>
        <button type="button" class="btn btn-link position-absolute bottom-0 end-0 mb-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal3">Usuń</button>
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

    <h4 class="mb-3">Dane do faktury</h4>
    <div class="border p-3 position-relative mb-3">
        <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal2">Edytuj</button>
        <button type="button" class="btn btn-link position-absolute bottom-0 end-0 mb-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal4">Usuń</button>
        <p id="companyBill" class="fw-bold mb-0" style="display:none;">Nazwa Firmy</p>      
        <p id="nameBill" class="fw-bold mb-0"><?php echo "$Name" . " ". "$Surname"; ?></p>             
        <p class="mb-0">Adress: <?php echo "$StreetFaktura"." "."$NumberFaktura"; ?></p>
        <p class="mb-0">Miasto: <?php echo "$Zip_CodeFaktura"." "."$CityFaktura"; ?></p>
        <p class="mb-0">Kraj: <?php echo "$CountryFaktura"; ?></p>
        <p class="mb-0">Nip: <?php echo "$NipFaktura"; ?></p> 
    </div>
</div>

<!-- pierwsze okno zmiany danych-->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 style="caret-color: transparent;" class="modal-title" id="modal1Label">Edytuj dane dostawy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="include\updateUserAddress.php" method="POST">
                        <div class="form-group">
                            <div class="row mb-3">
                                <p class="mb-2">Adres</p>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-0" id="inputStreetDelivery" name="street" value="<?php writeIfEmpty($StreetDostawa)?>" placeholder="Ulica" pattern="[a-zA-Z]+">
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control rounded-0" id="inputStreetNumber" name="streetNumber" value="<?php writeIfEmpty($NumberDostawa)?>" placeholder="" min="1" max="499">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <p class="mt-1 mb-2">Kod pocztowy</p>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputZipDelivery" name="zip" value="<?php writeIfEmpty($Zip_CodeDostawa)?>" placeholder="xx-xxx" pattern="([0-9]{2})-([0-9]{3})" maxlenght="6">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputCityDelivery" name="city" value="<?php writeIfEmpty($CityDostawa)?>" placeholder="Miasto" pattern="[a-zA-Z]+">
                                </div>
                            </div>
                            <input type="text" class="form-control rounded-0 mb-3" id="inputCountrySettings" name="country" value="<?php writeIfEmpty($CountryDostawa)?>" placeholder="Kraj" pattern="[a-zA-Z]+">                           
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn custom-btn rounded-0">Zapisz zmiany</button>
                        </div>                  
                </form>
            </div>
        </div>
    </div>
</div>

<!-- drugie okno zmiany danych-->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 style="caret-color: transparent;" class="modal-title" id="modal2Label">Zmiana danych do Faktury</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="include\updateFakturaAddress.php" method="POST">
                        <div class="form-group">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <input type="text" class="form-control rounded-0 mb-2" id="inputNameSettings" name="name" placeholder="<?php writeIfEmpty($companyNameFaktura)?>" pattern="[a-zA-Z]+" style="background-color: #e0e0e0; color: #808080;"
                                readonly>
                            </div>
                            <div class="col-3 d-flex justify-content-center">
                                <div class="form-group">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input rounded-0 me-3" type="checkbox" id="gridCheckSettings"></input>
                                        <label class="form-check-label" for="gridCheckSettings">
                                            <small>Firma</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <div class="row mb-3">
                                <p class="mb-2">Adres</p>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-0" id="inputStreetDelivery" name="street" value="<?php writeIfEmpty($StreetFaktura)?>" placeholder="Ulica" pattern="[a-zA-Z]+">
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control rounded-0" id="inputStreetNumber" name="streetNumber" value="<?php writeIfEmpty($NumberFaktura)?>" placeholder="" min="1" max="499">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="mb-2">Kod pocztowy</p>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputZipDelivery" name="zip" value="<?php writeIfEmpty($Zip_CodeFaktura)?>" placeholder="xx-xxx" pattern="([0-9]{2})-([0-9]{3})" maxlenght="6">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputCityDelivery" name="city" value="<?php writeIfEmpty($CityFaktura)?>" placeholder="Miasto" pattern="[a-zA-Z]+">
                                </div>
                            </div>
                            <input type="text" class="form-control mb-3" id="inputCountrySettings" name="country" value="<?php writeIfEmpty($CountryFaktura)?>" placeholder="Kraj" pattern="[a-zA-Z]+">
                            <label class="mb-2" for="inputNipSettings">NIP</label>
                            <input type="text" class="form-control rounded-0 mb-3" id="inputNipSettings" name="nip" value="<?php writeIfEmpty($NipFaktura)?>" placeholder="xx-xxx-xxxxxx-x" pattern="([a-zA-Z]{2})-([0-9]{3})-([0-9]{6})-([0-9])">                             
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn custom-btn rounded-0">Zapisz zmiany</button>
                        </div>                  
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 style="caret-color: transparent;" class="modal-title" id="modal3Label">Czy na pewno?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Wykonywana czynnośc jest <strong>nieodwracalna!</strong></p>
            </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cofnij</button>
                    <form action="include\deleteUserAddress.php" method="POST">
                        <button type="submit" class="btn btn-danger rounded-0">Tak, usuń</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 style="caret-color: transparent;" class="modal-title" id="modal4Label">Czy na pewno?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Wykonywana czynnośc jest <strong>nieodwracalna!</strong></p>
            </div>
                <form action="include\deleteFakturaAddress.php">
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cofnij</button>
                        <button type="submit" class="btn btn-danger rounded-0">Tak, usuń</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
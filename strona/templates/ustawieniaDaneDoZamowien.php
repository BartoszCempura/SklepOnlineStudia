<h2 align="center" class="mt-4">Dane do zamówień</h2>
<div class="container mt-4 mb-4 border shadow p-3 w-25" style="caret-color: transparent;">
    <h4 class="mb-3">Adres dostawy</h4>
    <div class="border p-3 position-relative mb-3">
        <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal1">Edytuj</button>
        <button type="button" class="btn btn-link position-absolute bottom-0 end-0 mb-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal3">Usuń</button>
        <p class="fw-bold mb-0">Imie Nazwisko</p>       
        <p class="mb-0">Adress: Street Number</p>
        <p class="mb-0">Miasto: Zip_code City</p>
        <p class="mb-0">Country</p>
        <div class="d-flex">
            <p class="mb-0">tel.</p>
            <p class="mb-0 ms-2">Phone_Number</p>
        </div>
        <p class="mb-0">Email</p>
    </div>

    <h4 class="mb-3">Dane do faktury</h4>
    <div class="border p-3 position-relative mb-3">
        <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal2">Edytuj</button>
        <button type="button" class="btn btn-link position-absolute bottom-0 end-0 mb-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal4">Usuń</button>
        <p id="companyBill" class="fw-bold mb-0" style="display:none;">Nazwa Firmy</p>      
        <p id="nameBill" class="fw-bold mb-0">Imie Nazwisko</p>             
        <p class="mb-0">Adress: Street Number</p>
        <p class="mb-0">Miasto: Zip_code City</p>
        <p class="mb-0">Country</p>
        <p class="mb-0">Nip</p> 
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
                <form action="" method="POST">
                        <div class="form-group">
                            <div class="row mb-3">
                                <p class="mb-2">Adres</p>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-0" id="inputStreetDelivery" name="street" placeholder="Ulica" pattern="[a-zA-Z]+">
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control rounded-0" id="inputStreetNumber" name="streetNumber" placeholder="" min="1" max="499">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <p class="mt-1 mb-2">Kod pocztowy</p>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputZipDelivery" name="zip" placeholder="xx-xxx" pattern="([0-9]{2})-([0-9]{3})" maxlenght="6">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputCityDelivery" name="city" placeholder="Miasto" pattern="[a-zA-Z]+">
                                </div>
                            </div>
                            <input type="text" class="form-control rounded-0 mb-3" id="inputCountrySettings" name="country" placeholder="Kraj" pattern="[a-zA-Z]+">                           
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
                <form action="" method="POST">
                        <div class="form-group">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <input type="text" class="form-control rounded-0 mb-2" id="inputNameSettings" name="name" placeholder="Nazwa" pattern="[a-zA-Z]+" style="background-color: #e0e0e0; color: #808080;"
                                readonly>
                            </div>
                            <div class="col-3 d-flex justify-content-center">
                                <div class="form-group">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input rounded-0 me-3" type="checkbox" id="gridCheckSettings">
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
                                    <input type="text" class="form-control rounded-0" id="inputStreetDelivery" name="street" placeholder="Ulica" pattern="[a-zA-Z]+">
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control rounded-0" id="inputStreetNumber" name="streetNumber" placeholder="" min="1" max="499">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="mb-2">Kod pocztowy</p>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputZipDelivery" name="zip" placeholder="xx-xxx" pattern="([0-9]{2})-([0-9]{3})" maxlenght="6">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control rounded-0" id="inputCityDelivery" name="city" placeholder="Miasto" pattern="[a-zA-Z]+">
                                </div>
                            </div>
                            <input type="text" class="form-control mb-3" id="inputCountrySettings" name="country" placeholder="Kraj" pattern="[a-zA-Z]+">
                            <label class="mb-2" for="inputNipSettings">NIP</label>
                            <input type="text" class="form-control rounded-0 mb-3" id="inputNipSettings" name="nip" placeholder="xx-xxx-xxxxxx-x" pattern="([a-zA-Z]{2})-([0-9]{3})-([0-9]{6})-([0-9])">                             
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
                        <button type="button" class="btn btn-danger rounded-0">Tak, usuń</button>
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
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cofnij</button>
                        <button type="button" class="btn btn-danger rounded-0">Tak, usuń</button>
                    </div>
            </div>
        </div>
    </div>
</div>
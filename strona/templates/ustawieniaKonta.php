<h2 align="center" class="mt-4">Ustawienia konta</h2>
<div class="container mt-4 mb-4 border shadow p-3 w-25">
    <h3 class="mb-3">Dane konta</h3>
    <p class="mb-2">Twoje dane</p>
    <div class="border p-3 position-relative mb-3">
        <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal1">Edytuj</button>
        <p class="fw-bold mb-0">Ala ma kota</p>
        <div class="d-flex">
            <p class="mb-0">tel.</p>
            <p class="mb-0 ms-2">test</p>
        </div>
    </div>

    <p class="mb-2">Adres email</p>
    <div class="border p-3 position-relative mb-3">
        <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal2">Edytuj</button>
        <p class="fw-bold mb-0">test@example.com</p>
    </div>

    <p class="mb-2">Hasło</p>
    <div class="border p-3 position-relative mb-4">
    <button type="button" class="btn btn-link position-absolute top-0 end-0 mt-3 me-3 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal3">Edytuj</button>
        <p class="fw-bold mb-0">••••••••</p>
    </div>

    <h3 class="mb-3">Usuwanie konta</h3>
    <p class="mb-3">Jeśli klikniesz w ten przycisk, usuniesz swoje konto w naszym sklepie. Upewnij się, że na pewno chcesz to zrobić – Twojego konta nie będziemy mogli przywrócić.</p>
    <button type="button" class="btn custom-btn" data-bs-toggle="modal" data-bs-target="#modal4">Usuń konto</button>
</div>

<!-- pierwsze okno zmiany danych-->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="caret-color: transparent;" class="modal-title" id="modal1Label">Edytuj dane konta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" id="inputNameSettings" name="name" placeholder="Imię" pattern="[a-zA-Z]+">
                            <input type="text" class="form-control" id="inputSurnameSettings" name="surname" placeholder="Nazwisko" pattern="[a-zA-Z]+">
                            <label  class="ps-1 my-2" for="inputPhoneSettings">Numer telefonu</label>
                            <input type="tel" pattern="([0-9]{3})([0-9]{3})([0-9]{3})" class="form-control mb-3" id="inputPhoneSettings" name="phoneNumber" placeholder="123456789" oninput="enforceDigits(event)" maxlenght="9">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn custom-btn">Zapisz zmiany</button>
                        </div>                  
                </form>
            </div>
        </div>
    </div>
</div>

<!-- drugie okno zmiany danych-->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="caret-color: transparent;" class="modal-title" id="modal2Label">Zmiana adresu email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                        <div class="form-group">
                            <label class="ps-1 mb-2" for="EmailSettings">Obecny email</label>
                            <input type="email" class="form-control mb-3" id="EmailSettings" name="email" placeholder="#" readonly>
                            <input type="email" class="form-control mb-3" id="inputEmailSettings" name="email" placeholder="Nowy email">
                            <input type="password" class="form-control mb-3" id="inputPasswordSettings" name="password" placeholder="Potwierdź hasłem" required>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn custom-btn">Zapisz zmiany</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- trzecie okno zmiany danych-->
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="caret-color: transparent;" class="modal-title" id="modal3Label">Edytuj dane konta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                        <div class="form-group">
                            <input type="password" class="form-control mb-3" id="inputOldPasswordSettings" name="Oldpassword" placeholder="Stare hasło" required>
                            <input type="password" class="form-control mb-3" id="inputNewPasswordSettings" name="Newpassword" placeholder="Nowe hasło" required>
                            <input type="password" class="form-control mb-3" id="inputNewPasswordConfirmSettings" name="NewpasswordConfirm" placeholder="Powtórz nowe hasło" required>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn custom-btn">Zapisz zmiany</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- komunikat przy usówaniu konta -->
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="caret-color: transparent;" class="modal-title" id="modal4Label">Czy na pewno?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Wykonywana czynnośc jest <strong>nieodwracalna!</strong></p>
            </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cofnij</button>
                        <button type="button" class="btn btn-danger">Tak, usuń</button>
                    </div>
            </div>
        </div>
    </div>
</div>
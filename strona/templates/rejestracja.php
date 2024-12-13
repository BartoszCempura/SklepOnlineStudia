<form class="w-75" action="./include/registration.php" method="post">          <!-- Do naprawy wyglad, pola dzialaja OK! -->
  <div class="row">
  <div class="form-group col-md-6">
      <label for="inputLogin4">Imie</label>
      <input type="text" class="form-control" id="inputName4" name="name" placeholder="Imię" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputLogin4">Nazwisko</label>
      <input type="text" class="form-control" id="inputSurname4" name="surname" placeholder="Nazwisko" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputLogin4">Nazwa użytkownika</label>
      <input type="text" class="form-control" id="inputLogin4" name="login" placeholder="Login" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputLogin4">Numer telefonu</label>
      <input type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" class="form-control" id="inputPhone4" name="phoneNumber" placeholder="123 456 789" required>
    </div>
    <div class="form-group">
    <label for="inputAddress">Email</label>
    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email" required>
  </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Hasło</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Hasło" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputConfirmPassword4">Powtórz hasło</label>
      <input type="password" class="form-control" id="inputConfirmPassword4" name="repeatPassword" placeholder="Powtórz hasło" required>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required>
      <label class="form-check-label" for="gridCheck">
        Akceptuje regulamin sklepu <small>(wymagane)</small>
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Zarejestruj się</button>

<?php
  require_once("./include/functions.php");
  raiseMessageAndRedirect("konto");                                 // Komunikat o przebiegu rejestracji oraz autoredirect w przypaku udanej rejestracji
?>

</form>

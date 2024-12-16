<div class="d-flex justify-content-center align-items-center" style="height: 50vh; margin: 6rem 0 6rem 0;">
    <div class="w-25 border p-3 shadow" style="margin: 50px 0;">

    <?php
  require_once __DIR__ . '/..//../include/global.php';
  raiseMessageAndRedirect("login");                                  // Komunikat o przebiegu rejestracji oraz autoredirect w przypaku udanej rejestracji
?>

<form class="" action="./include/registration.php" method="post">
  <div class="row">
  <div class="form-group col-md-6">
      <label class="ps-1 my-2" for="inputLogin4">Imie</label>
      <input type="text" class="form-control" id="inputName4" name="name" placeholder="Imię" required>
    </div>
    <div class="form-group col-md-6">
      <label class="ps-1 my-2" for="inputLogin4">Nazwisko</label>
      <input type="text" class="form-control" id="inputSurname4" name="surname" placeholder="Nazwisko" required>
    </div>
    <div class="form-group col-md-6">
      <label class="ps-1 my-2" for="inputLogin4">Nazwa użytkownika</label>
      <input type="text" class="form-control" id="inputLogin4" name="login" placeholder="Login" required>
    </div>
    <div class="form-group col-md-6">
      <label  class="ps-1 my-2" for="inputLogin4">Numer telefonu</label>
      <input type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" class="form-control" id="inputPhone4" name="phoneNumber" placeholder="123 456 789" required>
    </div>
    <div class="form-group">
    <label class="ps-1 my-2" for="inputAddress">Email</label>
    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email" required>
  </div>
    <div class="form-group col-md-6">
      <label class="ps-1 my-2" for="inputPassword4">Hasło</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Hasło" required>
    </div>
    <div class="form-group col-md-6">
      <label class="ps-1 my-2" for="inputConfirmPassword4">Powtórz hasło</label>
      <input type="password" class="form-control" id="inputConfirmPassword4" name="repeatPassword" placeholder="Powtórz hasło" required>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check my-3">
      <input class="form-check-input" type="checkbox" id="gridCheck" required>
      <label class="form-check-label" for="gridCheck">
        Akceptuje regulamin sklepu <small>(wymagane)</small>
      </label>
    </div>
  </div>
  <button type="submit" class="btn custom-btn rounded-0 mb-2">Zarejestruj się</button>



</form>

</div>
</div>


<style>
        .custom-btn {
          background-color: #7b6dfa;
          color: #fff;
        }
        .custom-btn:hover {
        background-color: #5d51c8;
        color: #fff;
    }
    .form-check-input:checked {
      background-color: #7b6dfa; /* Change the color when checked */
    }
    </style>
<form class="w-25" action="./include/login.php" method="post"> 
  <div class="form-group">
    <label for="exampleInputEmail1">Login</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="login" aria-describedby="emailHelp" placeholder="login">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Hasło</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="hasło">
  </div>
  <button type="submit" class="btn btn-primary">Zaloguj się</button>

<?php
  require_once("./include/functions.php");
  raiseMessageAndRedirect("konto");                                 // Komunikat o przebiegu rejestracji oraz autoredirect w przypaku udanej rejestracji
?>

</form>
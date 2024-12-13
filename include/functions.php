<?php
function authorisedUser(){
    if(isset($_SESSION['ID'])){
        return true;
    }
    return false;
}

function handleUser($content){
    if(authorisedUser() === false)
    {
    echo '<div class="d-grid justify-content-center">
            <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href=\'logowanie\'">Log In</button> </br>
            <button type="button" class="btn btn-outline-secondary btn-lg" onclick="window.location.href=\'rejestracja\'">Register</button>
          </div>';
    }
    else
    {
        $content; // SHOW CONTENT OF THE PAGE IF THE USER IS LOGGED IN
    }
}

function loginTaken($conn, $login){
    $sql = "SELECT * FROM `User` WHERE login = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../rejestracja?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Если нашли пользователя
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function passwordsDontMatch($password, $repeatPassword)
{
    if ($password !== $repeatPassword) {
        return true;
    }
    return false;
}




function raiseMessageAndRedirect($redirectURL)
{
    if(isset($_GET['error']))
    {
        if($_GET['error'] === 'logintaken')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Użyktownik z takim imieniem już istnieje!
                  </div>';
        }
        if($_GET['error'] === 'passwordsdontmatch')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Hasła nie są identyczne!
                  </div>';
        }
        if($_GET['error'] === 'incorrectpassword')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Nieprawidłowe hasło!
                  </div>';
        }
        if($_GET['error'] === 'usernotfound')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Nie znaleziono użyktownika o takim imieniu!
                  </div>';
        }
        if($_GET['error'] === 'none')
        {
            echo '<div class="alert alert-success" role="alert">
                    Rejestracja odbyła się poprawnie!
                  </div>';
            header("Refresh: 1; URL=$redirectURL");
        }
    }
}
?>
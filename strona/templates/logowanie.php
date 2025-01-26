<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="w-sm-25 border p-3 shadow">


    <?php
    
        require_once __DIR__ . '/..//../include/global.php';
        raiseMessageAndRedirect("home");  
                                   // Komunikat o przebiegu rejestracji oraz autoredirect w przypaku udanej rejestracji
    ?>

        <form action="./include/login.php" method="post"> 
            <div class="form-group">
                <label for="exampleInputEmail1" class="mb-2"><h2>Login</h2></label>
                <input type="text" class="form-control rounded-0" id="exampleInputEmail1" name="login" placeholder="login">
                <input type="password" class="form-control rounded-0 mt-3" id="exampleInputPassword1" name="password" placeholder="hasło">
            </div>
            
            <button type="submit" class="btn custom-btn rounded-0 mt-3 mb-3">Zaloguj się</button>

            <div>          
            <p class="d-inline ps-1">Nie masz konta??</p>
            <a href="rejestracja" class="d-inline ms-2 text-decoration-none">
             Sign Up
            </a>
            </div>
            
        </form>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="w-25 border p-3 shadow" style="margin: 50px 0;">


    <?php
    
        require_once __DIR__ . '/..//../include/global.php';
        raiseMessageAndRedirect("home");  
                                   // Komunikat o przebiegu rejestracji oraz autoredirect w przypaku udanej rejestracji
    ?>

        <form action="./include/login.php" method="post"> 
            <div class="form-group">
                <label for="exampleInputEmail1" class="mb-2"><h2>Login</h2></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="login" placeholder="login">
                <input type="password" class="form-control mt-3" id="exampleInputPassword1" name="password" placeholder="hasło">
            </div>
            <button type="submit" class="btn custom-btn rounded-0 mt-3 mb-2">Zaloguj się</button>
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
    </style> 
<h2 align="center" class="mt-4">Polubione produkty</h2>
<div class="container-fluid my-4">
    <div class="p-3 bg-light shadow-sm rounded-0">    
        <div class="container px-5">
            <?php
                require_once dirname(dirname(__DIR__)) . '/include/global.php';
                $userID = authorisedUser();
                raiseMessageAndRedirect("#");
                writeUserWishListProducts($client_conn, $site_conn, $userID);
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                {
                  if (isset($_POST['RemoveFromWishlist']) && isset($_POST['productID']) && isset($_POST['userID']))
                   {
                    $productID = $_POST['productID'];
                    $userID = $_POST['userID'];
        
                    RemoveFromWishlist($client_conn, $productID, $userID);
                  }
                }
            ?>
        </div>
    </div>
</div>
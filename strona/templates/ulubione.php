<h2 align="center" class="mt-4">Polubione produkty</h2>
<div class="container-fluid my-4">
    <div class="p-3 bg-light shadow-sm rounded-0">
        <div class="container">
            <?php
                require_once dirname(dirname(__DIR__)) . '/include/global.php';
                $userID = authorisedUser();
                writeUserWishListProducts($client_conn, $site_conn, $userID);
            ?>
        </div>
    </div>
</div>
<h2 align="center" class="mt-4">Twoj koszyk 
    <?php
        require_once __DIR__ . '/..//../include/global.php';
        $userID = authorisedUser();
        if(!empty($userID))
        {
            $products = getUserCart_Product($client_conn, $site_conn, $userID);
            $total = 0;
            $amountOfProducts = 0;
            foreach($products as $product)
            {
                $price = $product['Price'];
                $quantity = $product['Quantity'];
                $total += ($price * $quantity);
                $amountOfProducts += 1;
            }
        }
        else { $amountOfProducts = 0; $total = 0; }
        echo "(" . $amountOfProducts . ")";
    ?></h2>
<div class="container my-4">
    <div class="row">
        <!-- pojemnik na obiekty dodane do koszyka -->
            <div class="col-9 p-3 border shadow-sm rounded-0"> 
                    <?php
                    if(!empty($userID))
                    {
                        writeAllCartProducts($client_conn, $site_conn, $userID);
                    }
                    ?>      
            </div>
        <!-- pojemnik na przyciski i cenę -->
            <div class="col-3"> 
                <div class="p-3 border shadow-sm rounded-0">
                    <div class="d-flex justify-content-between">
                        <p class="mt-3 p-0">Do zapłaty:</p>
                        <p class="mt-2 p-0 fs-4"><strong><?php echo $total ." zł"?></strong></p>
                    </div>
                    <a href="DostawaPlatnosc" class="btn custom-btn rounded-0 w-100 mb-1 text-decoration-none">
                    Dalej
                    </a>
                    <button class="btn btn-secondary rounded-0 w-100" data-bs-toggle="modal" data-bs-target="#modal" style="caret-color: transparent;">Oblicz rate</button>
                </div>
            </div>
    </div>
</div>

<!-- okno dla obliczenia raty kredytu -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 style="caret-color: transparent;" class="modal-title" id="modalLabel">Oblicz ratę</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <p class="mb-0">tutaj będzie jakiś sówaczek</p>
            </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Zamknij</button>
                    </div>
            </div>
        </div>
    </div>
</div>
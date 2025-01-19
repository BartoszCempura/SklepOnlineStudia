<div class="container mt-4" style="caret-color: transparent;">
  <div class="row mb-3">
    <div class="col-4"> 
      <div class="py-2 bg-light shadow-sm rounded-0">
        <?php
        if(empty($_GET['Category']))
        {
          writeAllCategories($site_conn);
        } 
        else
        {
          writeAllAttributes($site_conn);  
        }
        ?>
      </div>
    </div>
    <div class="col-8"> 
      <?php raiseMessageAndRedirect("#"); ?>
      <div class="p-3 bg-light shadow-sm rounded-0">
<!-----------------------------produkt z bazy, pojemnik----------------------------------------------------------------------->
            <?php
            require_once dirname(dirname(__DIR__)) . '/include/global.php';

            

            if ($_SERVER['REQUEST_METHOD'] === 'GET') 
            {
                if (!empty($_GET['input'])) 
                {
                  $searchInput = trim(filter_var($_GET['input'], FILTER_SANITIZE_SPECIAL_CHARS));
                  $productsSearched = searchProducts($site_conn, $searchInput);

                  $filters = getURLfilters($site_conn);
                  $productsFiltered = getFilteredProducts($site_conn, $filters);
                  
                  $products = findCommon($productsFiltered, $productsSearched);
                  if (empty($products)) 
                  {
                    echo '<div class="alert alert-danger rounded-0 text-center" role="alert">
                            Nie znaleziono produktów ;(
                          </div>';
                  } 
                  else 
                  {
                      writeAllProducts($products, $client_conn, $site_conn);
                  }
              } 
              else 
              {
                  $filters = getURLfilters($site_conn);
                  $products = getFilteredProducts($site_conn, $filters);
          
                  if (empty($products)) 
                  {
                    echo '<div class="alert alert-danger rounded-0 text-center" role="alert">
                            Nie znaleziono produktów ;(
                          </div>';
                  } 
                  else 
                  {
                      writeAllProducts($products, $client_conn, $site_conn);
                  }
              }
          }

          if ($_SERVER['REQUEST_METHOD'] === 'POST')
          {
            if (isset($_POST['addProductToWishlist']) && isset($_POST['productID']) && isset($_POST['userID']))
             {
              $productID = $_POST['productID'];
              $userID = $_POST['userID'];
      

              addProductToWishlist($client_conn, $productID, $userID);
            }

          }

            ?>

<!---------------------------------------------------------------------------------------------------->
      </div>
    </div>
  </div>
</div>

<div class="container mt-4" style="caret-color: transparent;">
  <div class="row mb-3">
    <div class="col-4"> 
      <div class="py-2 bg-light shadow-sm rounded-0">
      <h4 class="border-bottom pb-2 ps-2"><strong>Filtry</strong></h4>
        <?php writeAllAttributes($site_conn); ?>
      </div>
    </div>
    <div class="col-8"> 
      <div class="p-3 bg-light shadow-sm rounded-0">
<!-----------------------------produkt z bazy, pojemnik----------------------------------------------------------------------->
            <?php
            require_once dirname(dirname(__DIR__)) . '/include/global.php';

            if ($_SERVER['REQUEST_METHOD'] === 'GET') 
            {
              $filters = getURLfilters($site_conn);

              $products = getFilteredProducts($site_conn, $filters);

              if (empty($products))  //                  
              {
                  echo "<p>Nie znaleziono produktów ;( </p>";
              } 
              else 
              {
                  writeAllProducts($products);
              }
            } 
            else if (empty($_GET))  // default values (when there are no filters)
            {
              $products = getAllProducts($site_conn);

              if (empty($products)) 
              {
                  echo "<p>Nie znaleziono produktów ;(</p>";
              } 
              else 
              {
                  writeAllProducts($products);
              }
            }

            ?>

<!---------------------------------------------------------------------------------------------------->
      </div>
    </div>
  </div>
</div>

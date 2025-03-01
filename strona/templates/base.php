<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

<title>Game Tech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        
        <link rel="stylesheet" href="strona/static/styles5.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
   <!-- <link rel="stylesheet" href="fontawesome-pro-5.15.3-web\fontawesome-pro-5.15.3-web\css\all.css"/> -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>   
  </head> 

   <body>

    <div class="" style="background-color: rgb(226, 223, 223);">

<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^nav menu^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
    <nav class="navbar navbar-expand-md navbar-light bg-light d-flex flex-column">
      <div class="container">
        <div class="row w-100">
          <!-- Logo -->
          <div class="col-6 col-md-3 d-flex align-items-center">
            <a class="navbar-brand" id="home" href="home">
              <img src="strona/static/otherImages/GAME_TECH_LOGO.png" alt="Logo" width="90" height="80"
                class="d-inline-block align-top">
            </a>
          </div>
    
          <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Serach bar kontener środkowy@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ --> 
          <div class="col-6 d-flex justify-content-center align-items-center d-none d-md-flex">
            <form action="include\search.php" method="POST" class="mx-auto">
              <div class="input-group shadow-sm" style="max-width: 450px;">
                <span class="input-group-text rounded-0" id="Wyszukaj">
                  <button class="btn p-0 border-0 d-flex justify-content-center" style="background: none;" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search hover-fill" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                    </svg>
                  </button>
                </span>
                <input type="text" class="form-control rounded-0" name="searchInput" placeholder="Wyszukaj" aria-label="Wyszukaj" aria-describedby="Wyszukaj">
              </div>
            </form>
          </div>

    
          <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@IKONY PO PRAWEJ STRONIE KONTENER @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
          <div class="col-6 col-md-3 d-flex justify-content-end align-items-center">
            <?php 
              if(!authorisedUser()){
              echo '<a class="btn btn-light rounded-0" aria-label="ulubione" href="logowanie" style="width: 64px; height: 64px; display: flex; justify-content: center; align-items: center;">
                <svg class="hover-fill" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                  <path
                    d="M25.738 7.601a6 6 0 0 0-8.324.156L16 9.172l-1.414-1.415A6 6 0 0 0 6.1 16.243l9.545 9.546a.5.5 0 0 0 .708 0l9.546-9.546a6 6 0 0 0 0-8.486l-.162-.156zm-.395 1.02a5 5 0 0 1-.15 6.915L16 24.727l-9.192-9.193a5 5 0 1 1 7.07-7.07l1.768 1.767a.5.5 0 0 0 .708 0l1.767-1.768a5 5 0 0 1 7.071 0l.15.157z">
                  </path>
                </svg>
              </a>';
            }
            else
            {
              echo '<a class="btn btn-light rounded-0" aria-label="ulubione" href="ulubione" style="width: 64px; height: 64px; display: flex; justify-content: center; align-items: center;">
                <svg class="hover-fill" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                  <path
                    d="M25.738 7.601a6 6 0 0 0-8.324.156L16 9.172l-1.414-1.415A6 6 0 0 0 6.1 16.243l9.545 9.546a.5.5 0 0 0 .708 0l9.546-9.546a6 6 0 0 0 0-8.486l-.162-.156zm-.395 1.02a5 5 0 0 1-.15 6.915L16 24.727l-9.192-9.193a5 5 0 1 1 7.07-7.07l1.768 1.767a.5.5 0 0 0 .708 0l1.767-1.768a5 5 0 0 1 7.071 0l.15.157z">
                  </path>
                </svg>
              </a>';
            }
           ?>
            <div class="dropdown">
              <button class="btn btn-light rounded-0 mx-4" style="width: 64px; height: 64px; display: flex; justify-content: center; align-items: center;">
            <a aria-label="panel klienta" href="#">
              <svg class="hover-fill" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                <path
                  d="M13.1 15.79C11.772 14.51 11 12.35 11 10c0-3.5 1.875-6 5-6s5 2.5 5 6c0 2.35-.772 4.51-2.1 5.79.365.632.672 1.075.954 1.356.488.49 1.067.792 2.26 1.253l.384.148.395.153c.305.121.565.23.815.346C25.545 19.887 27 22.143 27 24.5a.5.5 0 0 1-.146.354C25.744 25.964 20.217 27 16 27c-4.216 0-9.743-1.036-10.854-2.146A.5.5 0 0 1 5 24.5c0-2.356 1.455-4.613 3.292-5.454.25-.115.51-.225.815-.346a40.51 40.51 0 0 1 .78-.301c1.192-.46 1.77-.764 2.26-1.253.281-.281.588-.724.953-1.355zm.797.62c-.377.641-.707 1.107-1.043 1.444-.617.617-1.29.97-2.608 1.478l-.385.148-.385.15c-.29.115-.535.218-.768.325-1.423.652-2.611 2.434-2.702 4.314C7.212 25.091 12.238 26 16 26c3.762 0 8.788-.909 9.994-1.73-.09-1.881-1.279-3.663-2.702-4.316a16.666 16.666 0 0 0-.768-.324 37.747 37.747 0 0 0-.385-.15l-.385-.148c-1.318-.509-1.99-.861-2.608-1.478-.336-.337-.666-.803-1.043-1.444A3.99 3.99 0 0 1 16 17a3.99 3.99 0 0 1-2.103-.59zM16 5c-2.5 0-4 2-4 5 0 3.26 1.644 6 4 6s4-2.74 4-6c0-3-1.5-5-4-5z">
                </path>
              </svg>
            </a>
          </button>
<!-----------------------------Logowanie i menu konta użytkownika----------------------------------------------------------------------->
          <ul class="dropdown-menu rounded-0 d-flex flex-column" aria-labelledby="dropdownMenuButton">
          <?php 
        require_once __DIR__ . '/..//../include/global.php';
        if(!authorisedUser())
        {
          echo '<li class="pb-2 border-bottom text-center">              
                  <a class="dropdown-item" href="logowanie">Login</a>             
                </li>
                <li class="py-2 border-bottom text-center">          
                  <a class="dropdown-item" href="rejestracja">Sign Up</a>
                </li>
            <li class="d-flex justify-content-center py-2">
              <a class="dropdown-item" href="logowanie">
               <i class="bi bi-geo-alt me-2"></i>
                <span>Dane do zamówień</span>
              </a>
          </li>
            <li class="d-flex justify-content-center py-2">
                <a class="dropdown-item" href="logowanie">
                 <i class="bi bi-gear me-2"></i>
                  <span>Ustawienia konta</span>
                </a>
            </li>'; 
          }
          else
          { 
              echo '
                    <li class="d-flex justify-content-center py-2">
              <a class="dropdown-item" href="ustawieniaDaneDoZamowien">
               <i class="bi bi-geo-alt me-2"></i>
                <span>Dane do zamówień</span>
              </a>
          </li>
            <li class="d-flex justify-content-center py-2">
                <a class="dropdown-item" href="ustawieniaKonta">
                 <i class="bi bi-gear me-2"></i>
                  <span>Ustawienia konta</span>
                </a>
            </li>
            <li class="pt-2 border-top text-center">
                <a class="dropdown-item" href="include/logout.php">Log out</a>
            </li>'
                    ;
          }
        ?>  
          
            
          </ul>
          </div>
          <!---------------------------------------------------------------------------------------------------------------------->
            <?php
              if(!authorisedUser())
              {
                echo '<a class="btn btn-light rounded-0" aria-label="koszyk" href="logowanie" style="width: 64px; height: 64px; display: flex; justify-content: center; align-items: center;">
                  <svg class="hover-fill" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                    <path fill-rule="evenodd"
                      d="M22 21a3 3 0 1 1-2.236 1h-5.528a3 3 0 1 1-2.844-.938L8.098 6H4.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .488.393L9.558 8H25.5a.5.5 0 0 1 .488.608l-2 9A.5.5 0 0 1 23.5 18H11.746l.656 3H22zm2.877-12l-1.778 8H11.527l-1.75-8h15.1zM12 22a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm8 2a2 2 0 1 1 4 0 2 2 0 0 1-4 0z">
                    </path>
                  </svg>
                </a>';
              }
              else
              {
                echo '<a class="btn btn-light rounded-0" aria-label="koszyk" href="koszyk" style="width: 64px; height: 64px; display: flex; justify-content: center; align-items: center;">
                  <svg class="hover-fill" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                    <path fill-rule="evenodd"
                      d="M22 21a3 3 0 1 1-2.236 1h-5.528a3 3 0 1 1-2.844-.938L8.098 6H4.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .488.393L9.558 8H25.5a.5.5 0 0 1 .488.608l-2 9A.5.5 0 0 1 23.5 18H11.746l.656 3H22zm2.877-12l-1.778 8H11.527l-1.75-8h15.1zM12 22a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm8 2a2 2 0 1 1 4 0 2 2 0 0 1-4 0z">
                    </path>
                  </svg>
                </a>';
              }
            ?>
          </div>
          <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        </div>
      </div>
      <!-- search bar pojawiający się przy small screen -->
      <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center d-block d-md-none">
              <form action="include\search.php" method="POST" class="mx-auto">
                <div class="input-group shadow-sm" style="max-width: 450px;">
                  <span class="input-group-text rounded-0" id="Wyszukaj">
                    <button class="btn p-0 border-0 d-flex justify-content-center" style="background: none;" aria-label="Search">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search hover-fill" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                      </svg>
                    </button>
                  </span>
                  <input type="text" class="form-control rounded-0" name="searchInput" placeholder="Wyszukaj" aria-label="Wyszukaj" aria-describedby="Wyszukaj">
                </div>
              </form>
            </div>
      </div>
    </nav>
<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->

    <div class="bg-light shadow-sm">
      <div class="container-fluid border-top border-bottom">
        <div class="container">
        <div class="row justify-content-evenly">
          <div class="col-auto">
            <!-- Dropdown Button -->
            <div class="dropdown">
              <button class="btn btn-light rounded-0 text-hover dropdown-toggle" type="button" id="dropdownMenuButtonKomputer"
                data-bs-toggle="dropdown" aria-expanded="false">
                <b>Komputery</b>
              </button>
    
              <!-- Dropdown Menu -->
              <ul class="dropdown-menu dropdown-menu-start rounded-0" aria-labelledby="dropdownMenuButtonKomputer">
                <li><a class="dropdown-item" href="sklep?Category=Laptop">Laptop</a></li>
                <li><a class="dropdown-item" href="sklep?Category=PC">PC</a></li>
                <li><a class="dropdown-item" href="sklep?Category=AIO">AIO</a></li>
                <li><a class="dropdown-item" href="sklep?Category=Tablety">Tablet</a></li>
                <li><a class="dropdown-item" href="sklep?Category=Smartphones">Smartphone</a></li>
              </ul>
            </div>
          </div>
    
          <div class="col-auto">
            <!-- Dropdown Button -->
            <div class="dropdown">
              <button class="btn btn-light rounded-0 text-hover dropdown-toggle" type="button" id="dropdownMenuButtonAkcesoria"
                data-bs-toggle="dropdown" aria-expanded="false">
                <b>Akcesoria</b>
              </button>
    
              <!-- Dropdown Menu -->
              <ul class="dropdown-menu dropdown-menu-start rounded-0" aria-labelledby="dropdownMenuButtonAkcesoria">
                <li><a class="dropdown-item" href="sklep?Category=Monitory">Monitor</a></li>
                <li><a class="dropdown-item" href="sklep?Category=Mysze">Mysz</a></li>
                <li><a class="dropdown-item" href="sklep?Category=Klawiatury">Klawiatura</a></li>
                <li><a class="dropdown-item" href="sklep?Category=Kontrolery">Kontroler</a></li>
                <li><a class="dropdown-item" href="sklep?Category=Kable">Kable</a></li>
              </ul>
            </div>
          </div>
    
    
          <div class="col-auto">
            <a class="" aria-label="nav_wyprzedaz" href="">
              <button class="btn btn-light rounded-0 text-hover" id="dropdownMenuButtonWyprzedaz"><b>Wyprzedaż</b></button>
            </a>
          </div>
    

          <div class="col-auto">

            <div class="dropdown">
              <button class="btn btn-light rounded-0 text-hover dropdown-toggle" type="button" id="dropdownMenuButtonPromocje"
              data-bs-toggle="dropdown" aria-expanded="false">
              <b>Promocje i nowości</b>
            </button>

            <ul class="dropdown-menu dropdown-menu-start rounded-0" aria-labelledby="dropdownMenuButtonPromocje">
            <li><a class="dropdown-item" href="#" onclick="location.href='#promocje'">Promocje</a></li>
            <li><button class="dropdown-item" href="#" onclick="location.href='#nowosci'">Nowości</button></li>
            <li><a class="dropdown-item" href="#">Karty podarunkowe</a></li>
          </ul>
        </div>
      </div>
          
          </div>
        </div>
        </div>
      </div>
    </div>
<main>
    {{ content }}
            </main>
  
    <footer class="bg-light pt-5 d-flex flex-column align-items-center">
      <div class="container">
        <div class="row">
          <!-- Kontakt -->
          <div class="col-md-3 mb-4 d-flex flex-column align-items-center justify-content-start">
            <h5 id="kontakt-header" class="fw-bold mb-3">Kontakt</h5>
            <ul class="list-unstyled">
              <li class="mb-3">
              <i class="bi bi-telephone me-2"></i>
              <span> +1 123 456 789</span>
              </li>
              <li class="mb-3">
                <i class="bi bi-envelope me-2"></i>
                <span>contact@example.com</span>
              </li>
              <li>
                <i class="bi bi-geo-alt me-2 "></i>
                <span>Kwiatka 2 09-400 PŁOCK, Polska</span>
              </li>
            </ul>
          </div>
          
          <!-- Produkty -->
          <div class="col-md-3 mb-4 d-flex flex-column align-items-center justify-content-start">
            <h5 id="produkty-header" class="fw-bold">Produkty</h5>
            <ul class="list-unstyled text-hover-footer">
              <li><a href="#" class="text-decoration-none fw-bold">Promocje</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Nowości</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Wyprzedaż</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Karty podarunkowe</a></li>
            </ul>
          </div>
          <!-- Informacja -->
          <div class="col-md-3 mb-4 d-flex flex-column align-items-center justify-content-start">
            <h5 id="informacja-header" class="fw-bold">Informacja</h5>
            <ul class="list-unstyled text-hover-footer">
              <li><a href="#" class="text-decoration-none fw-bold">Dostawa i płatności</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Kredyt</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Ubezpieczenia</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Zwroty i reklamacje</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Najczęściej zadawane pytania</a></li>
            </ul>
          </div>
          <!-- O sklepie -->
          <div class="col-md-3 mb-4 d-flex flex-column align-items-center justify-content-start">
            <h5 id="sklep-header" class="fw-bold">O sklepie</h5>
            <ul class="list-unstyled text-hover-footer">
              <li><a href="#" class="text-decoration-none fw-bold">O nas</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Regulamin</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Polityka prywatności</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Polityka cookies</a></li>        
              <li><a href="#" class="text-decoration-none fw-bold">Opinie</a></li>
              <li><a href="#" class="text-decoration-none fw-bold">Kariera</a></li> 
            </ul>
          </div>
        </div>
      </div>
      <p class="text-center">@ 2024-2025 SklepOnline by Bartosz Cempura and Yaroslav Chausov </p>
    </footer>
    
    <style>
      .dropdown-toggle::after {
        display: none !important; /* brak arrow przy dropdown*/
      }
    </style>

    <script src="strona/static/index5.js"></script>
  
    </body>


</html>
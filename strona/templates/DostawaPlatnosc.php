<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

<title>Game Tech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        
        <link rel="stylesheet" href="strona/static/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
   <!-- <link rel="stylesheet" href="fontawesome-pro-5.15.3-web\fontawesome-pro-5.15.3-web\css\all.css"/> -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>   

  </head> 
<body>

<header class="container d-flex align-items-center justify-content-around mb-4 border">
    

    <div>
        <a  id="home" href="home">
            <img src="strona/static/otherImages/GAME_TECH_LOGO.png" alt="Logo" width="90" height="80" class="d-inline-block align-top">
        </a>
    </div>
    

    <div class="d-flex align-items-center justify-content-between position-relative" style="width: 50%;">

        <div class="d-flex flex-column align-items-center mt-5">
            <button class="btn btn-primary rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                <i class="bi bi-check-lg"></i>
            </button>
            <p class="mt-2">Koszyk</p> 
        </div>
        
 
        <div class="d-flex flex-column align-items-center mt-5">
            <button class="btn btn-link rounded-0 d-flex align-items-center justify-content-center p-1  border border-primary bg-light text-decoration-none" style="height:40px; width:40px;">
                2
            </button>
            <p class="mt-2">Dostawa</p> 
        </div>
        

        <div class="d-flex flex-column align-items-center mt-5">
            <button class="btn btn-primary rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                3
            </button>
            <p class="mt-2">Płatność</p> 
        </div>


        <div class="d-flex position-absolute w-100 px-3 z-n1">
            <div class="border border-primary w-75"></div>
            <div class="border border-secondary w-75"></div>
        </div>
    </div>
</header>


<!--
<div class="container">
    <div class="steps-container">

        <div class="step">
            <button class="btn btn-primary">
            <i class="bi bi-check-lg"></i>
            </button>
            <div class="step-name">Add to Cart</div>
            <div class="step-line"></div>
        </div>


        <div class="step">
            <button class="btn btn-primary">2</button>
            <div class="step-name">Checkout</div>
            <div class="step-line"></div>
        </div>


        <div class="step">
            <button class="btn btn-primary">3</button>
            <div class="step-name">Payment</div>
        </div>
    </div>
</div>


<header class="d-flex align-items-center justify-content-between mb-5">
<div class="mt-2" style="width: 200px;">
    <a href="home">
        <img src="strona/static/otherImages/GAME_TECH_LOGO.png" alt="Logo">
    </a>
</div>

<div class="fs-3">
    <div class="d-flex position-absolute w-100 z-n1">
        <div class="border border-primary" style="width: 50%"></div>
        <div class="border border-secondary" style="width: 50%;"></div>
    </div>
            <div class="d-flex align-items-center pl-2" style="background-color: #f2f2f2;">
            <div class="btn btn-primary rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px;">
                    <span>
                        <i class="bi bi-check-lg" style="inline-block font-size: 14px margin-bottom: 4px;"></i>
                    </span>
            </div>
            <div style="background-color: #f2f2f2; color: #ff503c; padding: 0 16px;">koszyk</div>
        </div>
            <div class="d-flex align-items-center pl-2" style="background-color: #f2f2f2;">
            <div class="btn btn-primary rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px; background-color: #ff503c; color: #fff;">
                    <span>
                        <span>2</span>
                    </span>
            </div>
            <div style="background-color: #f2f2f2; color: #3c1400; padding: 0 16px; font-weight: 600;">dostawa i płatność</div>
        </div>
            <div class="d-flex align-items-center pl-2" style="background-color: #f2f2f2;">
            <div class="btn btn-primary rounded-0 d-flex align-items-center justify-content-center p-1" style="height:40px; width:40px; border: 1px solid #757575; color: #757575;">
                    <span>
                        <span>3</span>
                    </span>
            </div>
            <div style="background-color: #f2f2f2; color: #757575;; padding: 0 16px; font-weight: 600;">podsumowanie</div>
        </div>
            </div>


<div style="width:190px;"></div>



                </header>
-->
<div class="container mt-5" style="background-color: blue;">
    <div class="row">
        <!-- Larger column (9 parts) -->
        <div class="col-md-9">
            <!-- First row inside the larger column -->
            <div class="row">
                <div class="col-12">
                    <p>This is the first row inside the larger column. Its height will adjust according to its content.</p>
                </div>
            </div>
            
            <!-- Second row inside the larger column -->
            <div class="row">
                <div class="col-12">
                    <p>This is the second row. Its height will adjust based on the content too.</p>
                </div>
            </div>
            
            <!-- Third row inside the larger column -->
            <div class="row">
                <div class="col-12">
                    <p>This is the third row. It will also change its size based on its content.</p>
                </div>
            </div>
        </div>

        <!-- Smaller column (3 parts) -->
        <div class="col-md-3">
            <p>This is the smaller column. Its width is 3 out of 12 parts, and it will remain fixed.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

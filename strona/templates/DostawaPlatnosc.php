<h2 align="center" class="mt-4">Dostawa i Płatność</h2>
<div class="container my-4">
    <div class="row mb-3">
        <!-- pojemnik na obiekty dodane do koszyka -->
            <div class="col-8"> 
            <!-- 1 obiekt dodany do koszyka -->            
                <div class="row bg-light shadow-sm rounded-0 align-items-center justify-content-between mb-2">
                    <div class="col-2" style="">
                        <a href="produktDane?id=$id" class="" style="flex-shrink: 0; width: 120px; height: 120px;">
                            <img src="./images/Lenovo Legion 5-16.jpg" alt="nazwa-zdjecia" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                        </a> 
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <p><strong>Pełna nazwa produktu</strong></p>
                    </div>
                    <div class="col-2 d-flex align-items-center mt-3">
                        <p class="fs-4">4.599 zł</p>
                    </div>
                    <div class="col-1 p-0">
                        <input type="number" class="form-control rounded-0" id="NumberOfItemns" name="NumberOfItemns" placeholder="" min="1" max="99">
                    </div>
                    <div class="col-1">
                        <button type="#" class="btn btn-light rounded-0" style="width: 48px; height: 48px; display: flex; justify-content: center; align-items: center; color: #7b6dfa">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        </button>
                    </div>
                </div>
                <!-- kolejny obiekt dodany do koszyka --> 
            </div>

            
        <!-- pojemnik na przyciski i cenę -->
            <div class="col-4"> 
                <div class="p-3 bg-light shadow-sm rounded-0">
                    <div class="d-flex justify-content-between">
                        <p class="mt-3 p-0">Do zapłoaty</p>
                        <p class="mt-2 p-0 fs-4"><strong>4.599 zł</strong></p>
                    </div>
                    <button class="btn custom-btn rounded-0 w-100 mb-1" style="caret-color: transparent;">Dalej</button>
                    <button class="btn btn-secondary rounded-0 w-100" data-bs-toggle="modal" data-bs-target="#modal" style="caret-color: transparent;">Oblicz rate</button>
                </div>
            </div>
    </div>
</div>
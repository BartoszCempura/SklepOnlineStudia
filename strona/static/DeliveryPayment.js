

// Zmienne globalne dla cen
let deliveryPrice = 0;
let paymentPrice = 0;

// Nasłuchujemy zmian na radio buttonach dla dostawy
document.querySelectorAll('input[name="radioDelivery"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const methodID = this.value; // Pobieramy value zaznaczonego radio buttona
        updateDeliveryPrice(methodID); // Funkcja AJAX do zaktualizowania ceny dostawy
    });
});

// Nasłuchujemy zmian na radio buttonach dla płatności
document.querySelectorAll('input[name="paymentRadio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const methodID = this.value; 
        updatePaymentPrice(methodID); // Funkcja AJAX do zaktualizowania ceny płatności
    });
});

function updateDeliveryPrice(methodID) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/SklepOnlineStudia/include/get_delivery_price.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send("methodID=" + methodID);

    xhr.onload = function() {
        if (xhr.status === 200) {
            deliveryPrice = parseFloat(xhr.responseText); // Ustawiamy cenę dostawy
            document.getElementById('deliveryPrice').innerHTML = deliveryPrice + " zł"; // Aktualizujemy cenę dostawy na stronie
            updateTotalPrice(); // Przeliczamy całkowitą cenę
        } else {
            console.error("Błąd podczas ładowania ceny dostawy");
        }
    };
}

function updatePaymentPrice(methodID) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/SklepOnlineStudia/include/get_payment_price.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send("methodID=" + methodID);

    xhr.onload = function() {
        if (xhr.status === 200) {
            paymentPrice = parseFloat(xhr.responseText); // Ustawiamy cenę płatności
            document.getElementById('paymentPrice').innerHTML = paymentPrice + " zł"; // Aktualizujemy cenę płatności na stronie
            updateTotalPrice(); // Przeliczamy całkowitą cenę
        } else {
            console.error("Błąd podczas ładowania ceny płatności");
        }
    };
}



//zmiana pól w dodawaniu adresu dostawy
function toggleFirmaFields(isChecked) {
    const nameField = document.getElementById('NameDeliveryBuy');
    const surnameField = document.getElementById('SurnameDeliveryBuy');
    const nameColumn = document.getElementById('nameColumn');
    const surnameColumn = document.getElementById('surnameColumn');

    if (isChecked) {
        // Change placeholders for 'Firma' state
        nameField.placeholder = "Nazwa";
        nameField.value = null;
        surnameField.placeholder = "NIP";
        surnameField.value = null;
        

        // Update column sizes to 7/5 ratio
        nameColumn.classList.remove('col-6');
        surnameColumn.classList.remove('col-6');
        nameColumn.classList.add('col-7');
        surnameColumn.classList.add('col-5');
    } else {
        // Revert to default state
        nameField.placeholder = "Imie";
        surnameField.placeholder = "Nazwisko";

        // Revert column sizes to 6/6 ratio
        nameColumn.classList.remove('col-7');
        surnameColumn.classList.remove('col-5');
        nameColumn.classList.add('col-6');
        surnameColumn.classList.add('col-6');
    }
}


//------------------------------------ zmiana dancyh faktura-----------------------------------------------
document.getElementById('gridCheckBuy').addEventListener('change', function() {
    toggleFirmaFields(this.checked);
});
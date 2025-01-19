function enforceDigits(event) { //funkcja dla submit number
    // pobiera aktualna wartośc pola
    let input = event.target;
    // usówa wszystko co nie jest cyfrą
    input.value = input.value.replace(/\D/g, '');
  }

//---------------------------- Funkcja dla Checkbox w dane do zamowień-faktura --------------------------------------------
const checkbox = document.getElementById('gridCheckSettings');
const inputField = document.getElementById('inputNameSettings');
const nameBill = document.getElementById('nameBill');
const companyBill = document.getElementById('companyBill');

checkbox.addEventListener('change', function() {
    if (this.checked) {

        inputField.removeAttribute('readonly');

        inputField.style.backgroundColor = ''; 
        inputField.style.color = '';
             
        companyBill.style.display = 'block';
        nameBill.style.display = 'none'; 
    } else {

        inputField.setAttribute('readonly', true);

        inputField.value = '';
        inputField.style.backgroundColor = '#e0e0e0'; 
        inputField.style.color = '#808080';

        nameBill.style.display = 'block';
        companyBill.style.display = 'none';
    }
});

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

// funkcja sprawdzająca czy na stronie DostawaPlatnosc był zaznacony check box dla Firma
function toggleCompanyCheckbox() {
    var isChecked = document.getElementById('gridCheckBuy').checked;
    document.getElementById('isCompany').value = isChecked ? "1" : "0";
}




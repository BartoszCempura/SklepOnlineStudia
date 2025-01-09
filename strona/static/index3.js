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
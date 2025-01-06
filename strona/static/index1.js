function enforceDigits(event) { //funkcja dla submit number
    // pobiera aktualna wartośc pola
    let input = event.target;
    // usówa wszystko co nie jest cyfrą
    input.value = input.value.replace(/\D/g, '');
  }
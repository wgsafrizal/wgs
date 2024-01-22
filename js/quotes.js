document.getElementById('namabarang').addEventListener('input', function() {
    var selectedOption = document.querySelector('#namabaranglist option[value="' + this.value + '"]');
    if (selectedOption) {
      var satuanValue = selectedOption.getAttribute('data-satuan');
      document.getElementById('satuan').value = satuanValue;
    }
  });



function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    
    ribuan = ribuan.join('.').split('').reverse().join('');
    
    // Add handling for numbers with decimal parts
    var decimalPart = angka.toString().split('.')[1];
    var formattedValue = 'Rp ' + ribuan;

    if (decimalPart) {
        formattedValue += '.' + decimalPart;
    }

    return formattedValue;
}

function updateFormattedPrice(inputElement) {
    var inputValue = inputElement.value.replace(/[^\d]/g, ''); // Hapus karakter selain digit
    var formattedValue = formatRupiah(inputValue);

    // Tampilkan nilai yang diformat
    inputElement.value = formattedValue;
}

function updateTotalPrice(inputElement) {
    // Find the parent row
    var row = inputElement.closest('tr');

    // Get the quantity and unit price values
    var qty = row.querySelector('td:nth-child(3) input').value;
    var unitPrice = inputElement.value.replace(/[^\d]/g, ''); // Remove non-numeric characters

    // Calculate the total price
    var totalPrice = qty * unitPrice;

    // Update the formatted value
    var formattedTotalPrice = formatRupiah(totalPrice);
    row.querySelector('td:nth-child(6) input').value = formattedTotalPrice;


    var inputValue = inputElement.value.replace(/[^\d]/g, ''); // Hapus karakter selain digit
    var formattedValue = formatRupiah(inputValue);


    // Tampilkan nilai yang diformat
    inputElement.value = formattedValue;

    updateSubtotal();
}

// Assume you have a function to update the subtotal, let's call it updateSubtotal()
function updateSubtotal() {
    var totalPriceInputs = document.querySelectorAll('td:nth-child(6) input');
    var subtotal = 0;

    totalPriceInputs.forEach(function (input) {
        var totalPrice = input.value.replace(/[^\d]/g, '');
        subtotal += parseInt(totalPrice, 10) || 0;
    });

    var formattedSubtotal = formatRupiah(subtotal);
    document.getElementById('subtotal').value = formattedSubtotal;

    // After updating the subtotal, also update the PPN and TotalAll
    updateFormattedPPN(document.getElementById('ppn'));
    updateTotalAll(document.getElementById('totalall'));
}

// Function to update PPN based on subtotal
function updateFormattedPPN(inputElement) {
    var subtotalValue = document.getElementById('subtotal').value.replace(/[^\d]/g, '');
    var ppnPercentage = 0.11;
    var ppnValue = parseFloat(subtotalValue) * ppnPercentage;
    var formattedPPN = formatRupiah(ppnValue);
    inputElement.value = formattedPPN;

    // After updating the PPN, also update the TotalAll
    updateTotalAll(document.getElementById('totalall'));
}

// Function to update TotalAll based on subtotal and PPN
function updateTotalAll(inputElement) {
    var subtotalValue = document.getElementById('subtotal').value.replace(/[^\d]/g, '');
    var ppnValue = document.getElementById('ppn').value.replace(/[^\d]/g, '');

    var totalAllValue = parseFloat(subtotalValue) + parseFloat(ppnValue);
    var formattedTotalAll = formatRupiah(totalAllValue);
    inputElement.value = formattedTotalAll;
}

// Existing code for formatRupiah function
function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);

    ribuan = ribuan.join('.').split('').reverse().join('');

    var decimalPart = angka.toString().split('.')[1];
    var formattedValue = 'Rp ' + ribuan;

    if (decimalPart) {
        formattedValue += '.' + decimalPart;
    }

    return formattedValue;
}

var counter = 2; // Inisialisasi counter sebagai variabel JavaScript

    function tambahquotes() {
        var table = document.getElementById('table-quotes'); // Dapatkan tbody dari tabel
        var newRow = table.insertRow(); // Tambahkan baris baru ke tabel

        var cells = []; // Array untuk menyimpan sel-sel pada baris baru

        for (var i = 0; i < 7; i++) {
            cells[i] = newRow.insertCell(i); // Tambahkan sel ke dalam baris baru
        }

        cells[0].classList.add('counter'); // Tambahkan kelas 'counter' pada sel pertama
        cells[0].textContent = counter++; // Isi sel pertama dengan nilai counter dan tingkatkan nilainya

        // Isi sisa sel sesuai dengan kebutuhan Anda
        cells[1].innerHTML = `
            <input style="width:370px" type="text" name="namabarang[]" class="namabarang" list="namabaranglist" autocomplete="off">
            <datalist id="namabaranglist">
                <!-- Tempatkan pilihan datalist di sini -->
            </datalist>
        `;
        cells[2].innerHTML = `<input style="width: 80px;" type="number" min=1 required name="qty[]" value="">`;
        cells[3].innerHTML = `<input style="width: 120px;" readonly type="text" name="satuan[]" class="satuan" id="satuan">`;
        cells[4].innerHTML = `<input  type="text" required name="price[]" value="" oninput="updateTotalPrice(this)">`;
        cells[5].innerHTML = `<input type="text" name="totalprice[]" readonly>`;
        cells[6].innerHTML = `<button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>`;
    }
  
  document.getElementById('namacustomer').addEventListener('input', function() {
    var selectedOption = document.querySelector('#namacustomerlist option[value="' + this.value + '"]');
    if (selectedOption) {
      var alamatValue = selectedOption.getAttribute('data-alamat');
          var emailValue = selectedOption.getAttribute('data-email');
 
      
      // Set nilai cp dan telp sesuai dengan opsi yang dipilih
      document.getElementById('alamat').value = alamatValue;
      document.getElementById('email').value = emailValue;
    }

  });
  document.getElementById('namacustomer').addEventListener('input', function() {
    var selectedOption = document.querySelector('#namacustomerlist option[value="' + this.value + '"]');
    if (selectedOption) {
      var alamatValue = selectedOption.getAttribute('data-alamat');
          var emailValue = selectedOption.getAttribute('data-email');
 
      
      // Set nilai cp dan telp sesuai dengan opsi yang dipilih
      document.getElementById('alamat').value = alamatValue;
      document.getElementById('email').value = emailValue;
    }
  });

  // Panggil fungsi populateUnit() ketika input nama barang diisi
  document.addEventListener('input', function(event) {
    if (event.target.classList.contains('namabarang')) {
      var selectedOption = document.querySelector('#namabaranglist option[value="' + event.target.value + '"]');
      if (selectedOption) {
        var satuanValue = selectedOption.getAttribute('data-satuan');
        var row = event.target.closest('tr'); // Dapatkan baris terdekat dari input

        // Perbarui nilai satuan pada kolom yang sesuai dalam baris tersebut
        row.querySelector('.satuan').value = satuanValue;
      }
    }
  });

  // Fungsi untuk menghapus baris dari tabel
  function deleteRow(button) {
    var row = button.closest('tr'); // Dapatkan baris terdekat dari tombol yang ditekan
    row.remove(); // Hapus baris dari tabel
  }

   var inputTanggal = document.getElementById("tglpo");
                    var tanggalHariIni = new Date().toISOString().split("T")[0];
                    inputTanggal.value = tanggalHariIni;




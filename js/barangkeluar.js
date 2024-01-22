$(document).ready(function () {
    // Inisialisasi Select2 untuk dropdown namabarangout
    $('#namabarangout').select2({
        ajax: {
            url: 'get_namabarangkeluar.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },

        language: {
            searching: function () {
                return 'Mencari...';
            }
        },
        placeholder: 'Cari...',
        minimumInputLength: 0,
        allowClear: true,
        formatNoMatches: function () {
            return 'Tidak ditemukan hasil';
        }
    });

    $('#namabarangout').on('select2:select', function (e) {
        // Memuat Serial Number saat terjadi perubahan pada namabarangout
        loadSerialNumbers();

    // Membersihkan inputan quantity
    resetQuantityInput();

    });

    // Memuat Serial Numbers saat halaman dimuat
    loadSerialNumbers();
});

// Fungsi untuk membersihkan inputan quantity
function resetQuantityInput() {
    var quantityInput = document.getElementById("stock_out");
    quantityInput.value = ""; // Mengosongkan nilai quantity

}

function loadSerialNumbers() {
    // Mendapatkan nilai selectedNamabarang
    var selectedNamabarang = $("#namabarangout").val();

    // Melakukan permintaan AJAX untuk mendapatkan serial numbers berdasarkan selectedNamabarang
    $.ajax({
        type: "GET",
        url: "load_serialnumbers.php",
        data: { namabarang: selectedNamabarang },
        dataType: 'json',
        success: function(response) {
            // Memilih dropdown serialnumberout
            var serialnumberDropdown = $("#serialnumberout");

            // Mengosongkan opsi yang sudah ada dan menambahkan opsi default yang dinonaktifkan
            serialnumberDropdown.empty();
            serialnumberDropdown.append('<option value="" selected disabled>Pilih Serial Number</option>');

            // Memeriksa apakah ada serial numbers yang tersedia
            if (response.serialnumbers.length > 0) {
                // Melakukan loop pada serial numbers dan menambahkannya sebagai opsi
                for (var i = 0; i < response.serialnumbers.length; i++) {
                    var option = $("<option>").text(response.serialnumbers[i]).val(response.serialnumbers[i]);
                    serialnumberDropdown.append(option);
                }

                // Mengisi nilai pada field lain berdasarkan data respons
                $("#stock").val(response.stock);
                $("#snout").val(response.sn);
                $("#kodebarangout").val(response.kodebarang);
                $("#satuanout").val(response.satuan);
            } else {
                // Jika tidak ada serial numbers yang tersedia, handle sesuai
                serialnumberDropdown.append('<option value="" disabled>No Serial Numbers available</option>');

                // Me-reset field lain saat namabarang berubah
                $("#kodebarangout").val("");
                $("#satuanout").val("");
                $("#stock").val("");
                $("#snout").val("");

                // Mengosongkan field terkait saat namabarang berubah
                $("#stock_out").val("");
                $("#serialnumberout").val("");
            }

            // Menonaktifkan atau mengaktifkan serialnumberout berdasarkan nilai snout
            handleSNChange();
        },
        error: function(error) {
            console.error(error);
        }
    });
}





function handleSNChange() {
    var snInput = document.getElementById("snout");
    var serialNumberInput = document.getElementById("serialnumberout");
    var quantityInput = document.getElementById("stock_out");

    // Menghilangkan spasi di awal dan akhir dari input SN
    var snValue = snInput.value.trim();

    // Log nilai SN ke konsol untuk debugging
    console.log("SN Value:", snValue);

    // Memeriksa apakah nilai SN mengandung 'yes' dalam bentuk apapun
    if (/^yes(?:, ?yes)*$/i.test(snValue)) {
        // Jika 'yes' atau 'yes, yes, ...', mengaktifkan field serial number dan menonaktifkan field quantity
        serialNumberInput.disabled = false;

        quantityInput.value = 1;
        quantityInput.disabled = true;

        // Set the value of snout to "Yes"
        $("#snout").val("Yes");
    } else {
        // Jika tidak 'yes' atau 'yes, yes, ...', menonaktifkan field serial number dan mengaktifkan field quantity
        serialNumberInput.value = "No"; // Me-reset serialnumber jika sn bukan 'Yes'
        serialNumberInput.disabled = true;
        quantityInput.disabled = false;

        // Set the value of snout to "No"
        $("#snout").val("No");
    }

    // Check if stock is more than one value and set it to the first value
    var stockValue = $("#stock").val();
    if (/^\d+(?:, ?\d+)*$/.test(stockValue)) {
        var stockArray = stockValue.split(',').map(function (item) {
            return item.trim();
        });
        // Set the value of stock to the first value
        $("#stock").val(stockArray[0]);
    }
}







function saveToBarangOut() {
    // Mendapatkan data dari formulir
    var tgl_out = $("#tgl_out").val();
    var namabarang = $("#namabarangout").val();
    var kodebarang = $("#kodebarangout").val();
    var satuan = $("#satuanout").val();
    var stock_out = $(".stock_out").val();
    var serialnumber = $("#serialnumberout").val();
    var kodeproduksi = $("#kodeproduksi").val();
    var nospk = $("#spk").val();
    var remarks = $("#remarksout").val();
    var stock = $("#stock").val();
    var sn = $("#snout").val();

    // Mengonversi stock_out dan stock menjadi nilai numerik
    var stockOutValue = parseInt(stock_out, 10);
    var stockValue = parseInt(stock, 10);

    // Memeriksa apakah stock_out lebih besar dari stock
    if (stockOutValue > stockValue) {
        alert("Permintaan Tidak Boleh Melebihi Stock");
        return;
    }


    if (/^Yes(?:, ?Yes)*$/i.test(sn) && (!serialnumber || serialnumber.trim() === "")) {
        alert("SN Yes membutuhkan Serial Number. Pilih Serial Number.");
        return;
    }
   

    if (!stock_out) {
        alert("Lengkapi Quantity");
        return;
    }




    if (!remarks) {
        alert("Lengkapi Remarks");
        return;
    }


    var data = {
        tgl_out: tgl_out,
        namabarang: namabarang,
        kodebarang: kodebarang,
        satuan: satuan,
        stock_out: stock_out,
        serialnumber: serialnumber,
        kodeproduksi: kodeproduksi,
        nospk: nospk,
        remarks: remarks,
        stock: stock
    };


    // Melakukan permintaan AJAX untuk menyimpan data ke server
    $.ajax({
        type: "POST",
        url: "save_changeskeluar.php", // Ganti dengan skrip sisi server sesungguhnya untuk menangani data
        data: data,
        success: function (response) {
            // Menangani respons dari server (jika diperlukan)
            console.log(response);

            // Menyembunyikan modal setelah penyimpanan berhasil
            $("#exampleModalLong").modal("hide");

            // Menampilkan alert setelah penyimpanan berhasil
            alert("Data berhasil disimpan!");

            // Menyegarkan halaman atau memperbarui tampilan data jika diperlukan
            location.reload(); // Anda mungkin ingin menggantinya dengan logika yang lebih sesuai
        },
        error: function (error) {
            // Menangani kesalahan, jika ada
            console.error(error);
        }
    });
}
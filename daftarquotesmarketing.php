<?php
include 'sesi.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/wgs.png" rel="icon">
    <title>WGS - Quotes Order</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="css/modul.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
   
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body id="page-top">
    <!-- Start wrapper-->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include 'topbar.php'; ?>
                <!-- TopBar -->









                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Marketing - Quotes</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">Marketing</li>
                            <li class="breadcrumb-item active" aria-current="page">Quotes Order</li>
                        </ol>
                    </div>

         


                    <!-- Row -->
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<?php
// Koneksi ke database (gantilah dengan informasi koneksi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query_oc = mysqli_query($conn, "SELECT max(oc) as ocTerbesar FROM oc");
$data_oc = mysqli_fetch_array($query_oc);
$ocTerbesar = $data_oc['ocTerbesar'];
$urutan_oc = (int) $ocTerbesar + 1;
$oc = $urutan_oc;

// Ambil nilai sales dari sesi.php
$query = "SELECT

namacustomer,
            status,
            quotes,
            tglquotes,
            sales,
            GROUP_CONCAT(namabarang SEPARATOR ', ') AS namabarang,
            GROUP_CONCAT(qty SEPARATOR ', ') AS qty,
            GROUP_CONCAT(price SEPARATOR ', ') AS price,
            GROUP_CONCAT(totalprice SEPARATOR ', ') AS totalprice,
            subtotal,
            notes
        
          FROM quotes
          WHERE status IN ('PENDING APPROVAL', 'APPROVED', 'PENDING OC APPROVAL','OC APPROVED', 'SPK ISSUED')

          GROUP BY status, quotes
          ORDER BY
            CASE
              WHEN status = 'PENDING APPROVAL' THEN 1

              WHEN status = 'APPROVED' THEN 2

              WHEN status = 'PENDING OC APPROVAL' THEN 3

              WHEN status = 'OC APPROVED' THEN 4


              WHEN status = 'SPK ISSUED' THEN 5

              


              ELSE 6 
         
            END";

                                    $result = $conn->query($query);


                                    ?>


<div class="table-responsive p-3">
    <table class="table align-items-center table-flush" id="dataTable">
        <thead class="thead-light">
            <tr>
                <th>Action</th>
                <th>Quotes</th>
                <th>Tgl</th>
                <th>Status</th>
                <th>Customer</th>
            </tr>
        </thead>
        <tbody>

<?php

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>
            <a href='#' class='infoButton' data-quotes='" . $row["quotes"] . "'>
                <i class='fa fa-info-circle' aria-hidden='true' title='Info'></i>
            </a>";

    // Tambahkan tombol dengan simbol @ hanya jika status = 'APPROVED'
    if ($row["status"] == 'APPROVED') {
        echo "&nbsp;&nbsp;&nbsp;"; // Spasi di sini

        echo "<a href='#' class='OCButton' data-oc='" . $row["quotes"] . "' onclick='openModalOC(\"" . $row["quotes"] . "\")'>
            <i class='fa fa-file-medical' aria-hidden='true' title='Tambah OC'></i>
        </a>";
    }

    echo "</td>
        <td>" . $row["quotes"] . "</td>
        <td>" . $row["tglquotes"] . "</td>
        <td>" . $row["status"] . "</td>
                <td>" . $row["namacustomer"] . "</td>


    
    </tr>";
}

echo "</tbody></table>"; 

if (empty($result)) {
    echo "Tidak ada data untuk sales ini.";
}

mysqli_close($conn);
?>
</div>
</div>



<style>
    .infoButton {
        margin-right: 12px;
        /* Atur nilai margin sesuai keinginan Anda */
    }

</style>


<div id="ModalOC" class="modal">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"><b> ORDER CONFIRMATION</b></h5>
                   <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="simpanocc" action="so.php" method="POST">
                    <div class="details-container">
                        <div class="detailsoc" style="color: black;">
                            <p id="idOCContainer"> ID OC : <input readonly type="text" name="oc" value="<?php echo $oc; ?>" id="idOCInput"></p>

<style>
    #idOCInput {
        border: none; /* Menghapus batasan input */
        outline: none; /* Menghapus highlight saat di-focus */
    }
</style>



                    <p>
                        Sales : <input type="text" name="sales" value="salesOC" id="salesOC" hidden>
                        <span id="salesOCDisplay"></span>
                    </p>

<input type="text" hidden name="quotes" id="QuotesInput">
                          
                     

                            <p>
                                CUSTOMER : <input type="text" hidden name="namacustomer" id="namacustomerOC" value="namacustomerOC">
                                <span id="namacustomerOCDisplay"></span>
                            </p>
                         
                            <p>
                                EMAIL : <input type="text" hidden name="email" id="emailOC" value="emailOC">
                                <span id="emailOCDisplay"></span>
                            </p>

                            <p>
                                ALAMAT : <input type="text" hidden name="alamat" value="alamatOC" id="alamatOC">
                                <span id="alamatOCDisplay"></span>
                            </p>



                        </div>

                        <div class="detailcustomeroc" style="color: black;">


                            <p>
                                PO CS : <input type="text" name="pocust" id="">
                            </p>


                            <p> Tgl PO : <input type="date" id="tglpo" name="tglpo" required="required">

                                          <script>
                                    var inputTanggal = document.getElementById("tglpo");
                                    var tanggalHariIni = new Date().toISOString().split("T")[0];
                                    inputTanggal.value = tanggalHariIni;
                                </script>
                            </p>


                            <p> Tgl OC : <input readonly type="date" id="tgloc" name="tgloc" required="required">

                                          <script>
                                    var inputTanggal = document.getElementById("tgloc");
                                    var tanggalHariIni = new Date().toISOString().split("T")[0];
                                    inputTanggal.value = tanggalHariIni;
                                </script>
                            </p>



                            <p> Status :

                                <input hidden type="text" name="status" value="PENDING OC" readonly>
                                    <span> Pending OC</span>


                            </p>



                        </div>
                    </div>


                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataoc">
                            <thead class='thead-light'>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="dataocBody"></tbody>
                        </table>
                    </div>

                    <br>
                    <div class="rincianharga">
                        <div id="invoiceDetails">
                            <p><strong>Subtotal : </strong><input type="text" name="subtotal" id="subtotal" readonly></p>
                            <p><strong>PPN : </strong><input type="text" name="ppn" readonly id="ppn"></p>
                            <p><strong>Total All : </strong><input type="text" name="totalall" readonly id="totalall"></p>
                        </div>
                    </div>


                    <br>

                    <button type="submit" class="submit-button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function openModalOC(quotes) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var dataInfo = JSON.parse(xhr.responseText);

                    document.getElementById("QuotesInput").value = quotes;

                    document.getElementById("salesOC").value = dataInfo.sales;
                    document.getElementById("salesOCDisplay").textContent = dataInfo.sales;

                    document.getElementById("namacustomerOC").value = dataInfo.namacustomer;
                    document.getElementById("namacustomerOCDisplay").textContent = dataInfo.namacustomer;

                    document.getElementById("emailOC").value = dataInfo.email;
                    document.getElementById("emailOCDisplay").textContent = dataInfo.email;

                    document.getElementById("alamatOC").value = dataInfo.alamat;
                    document.getElementById("alamatOCDisplay").textContent = dataInfo.alamat;







                    // Tampilkan data barang di dalam tabel
                    showDetails(dataInfo.dataBarangOC);
                } else {
                    alert("Failed to fetch information.");
                }
            }
        };



        xhr.open('GET', 'get_data_quotes.php?quotes=' + encodeURIComponent(quotes), true);
        xhr.send();

        var modalOC = document.getElementById("ModalOC");
        modalOC.style.display = "flex";

        window.addEventListener('click', function(event) {
            if (event.target == modalOC) {
                closeModalOC();
            }
        });
    }


    function closeModalOC() {
        var modalOC = document.getElementById("ModalOC");
        modalOC.style.display = "none";
    }

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



    function showDetails(dataBarang) {

        var subtotal = 0;
        var ppn = 0;
        var totalall = 0;

        var tableBody = document.getElementById("dataocBody");
        tableBody.innerHTML = "";

        dataBarang.forEach(function(barang, i) {
            var row = tableBody.insertRow(i);

            // Kolom Nama Barang
            var cell1 = row.insertCell(0);
            var inputNamaBarang = document.createElement("input");
            inputNamaBarang.type = "text";
            inputNamaBarang.name = "namabarang[]";
            inputNamaBarang.value = barang.namabarang;
            inputNamaBarang.addEventListener("input", function() {
                barang.namabarang = this.value;
            });
            cell1.appendChild(inputNamaBarang);

            // Kolom Quantity
            // Kolom Quantity
            var cell2 = row.insertCell(1);
            var inputQty = document.createElement("input");
            inputQty.type = "number";
            inputQty.name = "qty[]";
            inputQty.min = "1";
            inputQty.value = barang.qty;
            inputQty.addEventListener("input", function() {
                // Update nilai qty pada objek barang
                barang.qty = this.value;

                // Memanggil fungsi untuk memperbarui totalprice
                updateTotalPrice(this, dataBarang);
            });

            cell2.appendChild(inputQty);



            // Kolom Satuan
            var cell3 = row.insertCell(2);
            var inputSatuan = document.createElement("input");
            inputSatuan.type = "text";
            inputSatuan.name = "satuan[]";
            inputSatuan.value = barang.satuan;
            inputSatuan.addEventListener("input", function() {
                barang.satuan = this.value;
            });
            cell3.appendChild(inputSatuan);

            var cell4 = row.insertCell(3);
            var inputPrice = document.createElement("input");
            inputPrice.type = "text";
            inputPrice.name = "price[]";

            // Menggunakan formatRupiah untuk nilai awal
            inputPrice.value = barang.price;

            // Menyimpan nilai numerik di latar belakang
            var numericPrice = barang.price;

            inputPrice.addEventListener("input", function() {
                var numericValue = this.value.replace(/[^\d]/g, ''); // Hanya angka
                numericPrice = parseFloat(numericValue) || 0;

                // Set nilai pada elemen input menggunakan formatRupiah
                this.value = formatRupiah(numericPrice);

                // Memperbarui total price dan totalall saat harga berubah
                updateTotalPrice(row, dataBarang, i);
            });

            cell4.appendChild(inputPrice);
            // Kolom Total Price
            var cell5 = row.insertCell(4);
            var inputTotalPrice = document.createElement("input");
            inputTotalPrice.type = "text";
            inputTotalPrice.name = "totalprice[]";

            // Mengatur format nilai totalprice saat pertama kali diatur
            inputTotalPrice.value = barang.totalprice;

            // Menyimpan nilai numerik di belakang layar
            var numericTotalPrice = parseFloat(barang.totalprice) || 0;

            inputTotalPrice.addEventListener("input", function() {
                // Dapatkan nilai numerik dari input
                var nilaiNumerik = this.value.replace(/[^\d.]/g, '');

                // Konversi nilai numerik menjadi float
                numericTotalPrice = parseFloat(nilaiNumerik) || 0;

                // Hitung total semua harga
                updateTotalAll(dataBarang);
            });

            cell5.appendChild(inputTotalPrice);

            function updateTotalPrice(inputElement, dataBarang) {
                // Temukan baris induk
                var baris = inputElement.closest('tr');

                // Dapatkan nilai kuantitas dan harga satuan
                var qty = parseFloat(baris.querySelector('td:nth-child(2) input').value);
                var priceInput = baris.querySelector('td:nth-child(4) input');
                var priceValue = priceInput.value.replace(/[^\d.]/g, '');

                // Ubah tanda titik menjadi tanda desimal jika ada
                var price = parseFloat(priceValue.replace(/\./g, '')) || 0;



                // Hitung totalprice
                var totalprice = qty * price;
                // Perbarui nilai yang diformat pada input totalprice
                var inputTotalPrice = baris.querySelector('td:nth-child(5) input');
                inputTotalPrice.value = formatRupiah(totalprice);

                // Update totalprice for the corresponding dataBarang item
                var index = Array.from(baris.parentNode.children).indexOf(baris);
                dataBarang[index].totalprice = totalprice;
                dataBarang[index].qty = qty;


                // Hitung ulang subtotal berdasarkan totalprice yang ada
                var subtotal = dataBarang.reduce(function(acc, item) {
                    return acc + (item.totalprice || 0);
                }, 0);

                // Perbarui nilai subtotal di elemen dengan ID 'subtotal'
                document.getElementById('subtotal').value = formatRupiah(subtotal);


                // Hitung PPN (11% dari subtotal)
                var ppnRate = 0.11; // 11 persen
                var ppn = subtotal * ppnRate;

                // Perbarui nilai PPN di elemen dengan ID 'ppn'
                document.getElementById('ppn').value = formatRupiah(ppn);

                var totalall = subtotal + ppn;

                document.getElementById('totalall').value = formatRupiah(totalall);


            }



        });
    }
</script>

</div>



<div id="myModal" class="modal">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"><b>QUOTES ORDER</b></h5>
                <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="quotes" style="color:black;">
                    <div style="display: flex; flex-wrap: wrap;">
                        <div style="flex: 2; margin-right: 18px;">
                            <p><strong>NO QUOTES: </strong><span id="quotesDisplay"></span></p>
                            <p><strong>TGL QUOTES : </strong><span id="tglquotesDisplay"></span></p>

                            <p><strong>Status : </strong><span id="statusDisplay"></span></p>

                        </div>

                        <div class="customer" style="color:black; text-align: right">
                            <p><strong>CUSTOMER : </strong><span id="namacustomerDisplay"></span></p>
                            <p><strong>EMAIL : </strong><span id="emailDisplay"></span></p>
                            <p><strong>ALAMAT : </strong><span id="alamatDisplay"></span></p>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="barangTableDetail">
                            <thead class='thead-light'>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="barangTableBody"></tbody>
                        </table>
                    </div>

                    <br>

                    <div class="rincianharga" style="color:black;">
                        <div id="invoiceDetails">
                            <p><strong>Subtotal : </strong><span id="subtotalDisplay"></span></p>
                            <p><strong>Catatan : </strong><span id="catatanDisplay"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->



                    <!-- Scroll to top -->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>






    <script>
        var modal = document.getElementById('myModal');

        // Ketika pengguna mengklik di luar modul, tutup modulnya
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };

        // Tombol close di dalam modul untuk menutup modul saat diklik
        var closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', function() {
            modal.style.display = 'none';
        });


        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            var infoButtons = document.querySelectorAll('.infoButton'); // Mengganti editButtons menjadi infoButtons

            span.onclick = function() {
                modal.style.display = "none";
            };

            // Deklarasikan variabel infoButtons
            var infoButtons;

            infoButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var quotes = this.dataset.quotes;

                    // Kirim permintaan AJAX ke PHP untuk mengambil data barang
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                showDetails(data.barang); // Ubah sesuai struktur JSON yang diterima
                            } else {
                                alert("Gagal mengambil data dari server.");
                            }
                        }
                    };

                    xhr.open('GET', 'get_barang.php?quotes=' + encodeURIComponent(quotes), true);
                    xhr.send();
                });
            });

            function showDetails(barang) {
                // Bersihkan isi tabel sebelum menambahkan data baru
                document.getElementById("barangTableBody").innerHTML = "";

                // Tambahkan data barang ke dalam tabel
                barang.forEach(function(item) {
                    var row = document.createElement("tr");
                    row.innerHTML = "<td>" + item.namabarang + "</td>  <td>" + item.qty + "</td>  <td>" + item.satuan + "</td> <td>" + item.price + "</td> <td>" + item.totalprice + "</td>";
                    document.getElementById("barangTableBody").appendChild(row);
                });

                // Set nilai quotesDisplay dan salesDisplay
                document.getElementById("quotesDisplay").textContent = barang[0].quotes; // Ubah sesuai struktur JSON yang diterima
                document.getElementById("subtotalDisplay").textContent = barang[0].subtotal; // Ubah sesuai struktur JSON yang diterima
                document.getElementById("tglquotesDisplay").textContent = barang[0].tglquotes; // Ubah sesuai struktur JSON yang diterima


                document.getElementById("statusDisplay").textContent = barang[0].status; // Ubah sesuai struktur JSON yang diterima
                document.getElementById("catatanDisplay").textContent = barang[0].notes; // Ubah sesuai struktur JSON yang diterima

                document.getElementById("namacustomerDisplay").textContent = barang[0].namacustomer; // Ubah sesuai struktur JSON yang diterima
                document.getElementById("alamatDisplay").textContent = barang[0].alamat; // Ubah sesuai struktur JSON yang diterima
                document.getElementById("emailDisplay").textContent = barang[0].email; // Ubah sesuai struktur JSON yang diterima


                modal.style.display = "block";
            }
        });
    </script>



                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <!-- Sertakan skrip Select2 -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <script src="vendor/select2/dist/js/select2.min.js"></script>

                    <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>

                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <script src="js/editmaster.js"></script>
                    <script src="js/ruang-admin.min.js"></script>
                    <script src="js/simpanmasterunits.js"></script>
                    <script src="js/get_master.js"></script>
                    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
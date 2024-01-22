<?php

include 'sesi.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = new mysqli("localhost", "root", "", "wgs");

// Periksa apakah koneksi berhasil atau tidak
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}


$koneksi = mysqli_connect('localhost', 'root', '', 'wgs');
$query_spk = mysqli_query($koneksi, "SELECT max(spk) as spkTerbesar FROM spk");
$data_spk = mysqli_fetch_array($query_spk);
$spkTerbesar = $data_spk['spkTerbesar'];
$urutan_spk = (int) $spkTerbesar + 1;
$spk = $urutan_spk;

// Ambil nilai sales dari sesi.php
$sales = '$username' ; // Sesuaikan dengan variabel sesi.php yang sesuai
$query = "SELECT
oc,tgloc,
            quotes,
            status,
            sales,
            GROUP_CONCAT(namabarang SEPARATOR ', ') AS namabarang,
            GROUP_CONCAT(qty SEPARATOR ', ') AS qty,
            GROUP_CONCAT(price SEPARATOR ', ') AS price,
            GROUP_CONCAT(totalprice SEPARATOR ', ') AS totalprice,
            subtotal
          FROM oc
        
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
$result = mysqli_query($koneksi, $query);

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
    <title>WGS - Daftar OC</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Marketing - Daftar OC</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">Marketing</li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar OC</li>
                        </ol>
                    </div>






                    <!-- Row -->
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="dataTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>OC</th>
                                                    <th>Tgl</th>
                                                    <th>Status</th>
                                                    <th>Sales</th>
                                                    <th>Customer</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
    <td><a href='#' class='infoButton' data-oc='" . $row["oc"] . "'><i class='fa fa-info-circle' aria-hidden='true' title='Info'></i></a>";

        // Tambahkan tombol dengan simbol @ hanya jika status = 'APPROVED'
        if ($row["status"] == 'OC APPROVED') {
            echo "&nbsp;&nbsp;&nbsp;"; // Spasi di sini

            echo "<a href='#' class='OCButton' data-oc='" . $row["oc"] . "' onclick='openModalOC(\"" . $row["oc"] . "\")'><i < class='fa fa-plus-square' aria-hidden='true' title='Buat SPK'></i></a>";
        }

        echo "</td>
                <td>" . $row["oc"] . "</td>
                <td>" . $row["tgloc"] . "</td>
                <td>" . $row["quotes"] . "</td>               
                <td>" . $row["status"] . "</td>
                <td>" . $row["sales"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data untuk sales ini.";
}

mysqli_close($koneksi);
?>



    </tbody>
                                        </table>
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
                <h5 class="modal-title" id="exampleModalScrollableTitle"><b>ORDER CONFIRMATION</b></h5>
                <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="simpanspk" action="simpanspk.php" method="POST">
                <div class="modal-body">
                    <div class="details-container">
                        <div style="display: flex; justify-content: space-between; flex-direction: row-reverse;">
                            <div class="detailsoc" style="color: black; width: 48%;">

                                <p>
                                    <input type="text" hidden name="namacustomer" id="namacustomerOC" value="namacustomerOC">
                                    <span id="namacustomerOCDisplay"></span>
                                </p>

                                <p>
                                    <input type="text" hidden name="pocust" id="pocustOC" value="pocustOC">
                                    <span id="pocustOCDisplay"></span>
                                </p>

                                <p>
                                    <input type="text" name="email" hidden id="emailOC" value="emailOC">
                                    <span id="emailOCDisplay"></span>
                                </p>

                                <p>
                                    <input type="text" name="alamat" hidden value="alamatOC" id="alamatOC">
                                    <span id="alamatOCDisplay"></span>
                                </p>

                            </div>
                            <div class="detailcustomeroc" style="color: black; width: 100%;">

                                <p> <input type="text" name="status" value="SPK ISSUED"> </p>


                                <p>
                                    <input readonly type="date" id="tglspk" name="tglspk" required="required">
                                    <script>
                                        var inputTanggal = document.getElementById("tglspk");
                                        var tanggalHariIni = new Date().toISOString().split("T")[0];
                                        inputTanggal.value = tanggalHariIni;
                                    </script>
                                </p>

                                <p>
                                    <input type="text" id="spk" readonly value="<?php echo $spk; ?>" name="spk">
                                </p>

                                <p>
                                    <input type="text" hidden name="oc" id="ocInput">
                                    <span id="ocDisplay"></span>
                                </p>

                                <p>
                                    <input type="text" hidden name="sales" value="salesOC" id="salesOC">
                                    <span id="salesOCDisplay"></span>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="table-container">
                        <div class="table-responsive">
                            <table id="dataoc">
                                <thead class='thead-light'>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody id="dataocBody"></tbody>
                            </table>

                        </div>
                    </div>
                    <br>
                    <div class="tombol">

                        <button type="submit" class="submit-button">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModalOC(oc) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var dataInfoOC = JSON.parse(xhr.responseText);

                    document.getElementById("ocInput").value = oc;
                    document.getElementById("ocDisplay").textContent = oc;

                    document.getElementById("salesOC").value = dataInfoOC.sales;
                    document.getElementById("salesOCDisplay").textContent = dataInfoOC.sales;

                    document.getElementById("namacustomerOC").value = dataInfoOC.namacustomer;
                    document.getElementById("namacustomerOCDisplay").textContent = dataInfoOC.namacustomer;

                    document.getElementById("emailOC").value = dataInfoOC.email;
                    document.getElementById("emailOCDisplay").textContent = dataInfoOC.email;

                    document.getElementById("alamatOC").value = dataInfoOC.alamat;
                    document.getElementById("alamatOCDisplay").textContent = dataInfoOC.alamat;


                    document.getElementById("pocustOC").value = dataInfoOC.pocust;
                    document.getElementById("pocustOCDisplay").textContent = dataInfoOC.pocust;

                    // Tampilkan data barang di dalam tabel
                    showDetails(dataInfoOC.dataBarangOC);
                } else {
                    alert("Failed to fetch information.");
                }
            }
        };

        xhr.open('GET', 'get_data_oc.php?oc=' + encodeURIComponent(oc), true);
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

    function showDetails(dataBarang) {

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
            inputNamaBarang.readOnly = true;
            cell1.appendChild(inputNamaBarang);

            // Kolom Quantity
            // Kolom Quantity
            var cell2 = row.insertCell(1);
            var inputQty = document.createElement("input");
            inputQty.type = "text";
            inputQty.name = "qty[]";
            inputQty.value = barang.qty;
            inputQty.addEventListener("input", function() {
                // Update nilai qty pada objek barang
                barang.qty = this.value;

                // Memanggil fungsi untuk memperbarui totalprice
                updateTotalPrice(this, dataBarang);
            });

            inputQty.readOnly = true;
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

            inputSatuan.readOnly = true;
            cell3.appendChild(inputSatuan);






        });
    }
</script>






<div id="myModal" class="modal">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"><b>ORDER CONFIRMATION</b></h5>
                <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 2; margin-right: 18px;">
                        <p><strong>TGL OC : </strong><span id="tglocDisplay"></span></p>
                        <p><strong>OC : </strong><span id="occDisplay"></span></p>
                        <p><strong>QUOTES: </strong><span id="quotesDisplay"></span></p>
                        <p><strong>SALES : </strong><span id="salesDisplay"></span></p>
                    </div>

                    <div class="customer" style="text-align: right;">
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

                            </tr>
                        </thead>
                        <tbody id="barangTableBody"></tbody>
                    </table>
                </div>

                <br>

                <div class="rincianharga" style="color:black;">
                    <div id="invoiceDetails">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>








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
                var oc = this.dataset.oc;

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

                xhr.open('GET', 'get_barangoc.php?oc=' + encodeURIComponent(oc), true);
                xhr.send();
            });
        });

        function showDetails(barang) {
            // Bersihkan isi tabel sebelum menambahkan data baru
            document.getElementById("barangTableBody").innerHTML = "";

            // Tambahkan data barang ke dalam tabel
            barang.forEach(function(item) {
                var row = document.createElement("tr");
                row.innerHTML = "<td>" + item.namabarang + "</td>  <td>" + item.qty + "</td>  <td>" + item.satuan + "</td> ";
                document.getElementById("barangTableBody").appendChild(row);
            });

            // Set nilai quotesDisplay dan salesDisplay

            document.getElementById("occDisplay").textContent = barang[0].oc; // Ubah sesuai struktur JSON yang 
            document.getElementById("quotesDisplay").textContent = barang[0].quotes; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("salesDisplay").textContent = barang[0].sales; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("tglocDisplay").textContent = barang[0].tgloc; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("namacustomerDisplay").textContent = barang[0].namacustomer; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("alamatDisplay").textContent = barang[0].alamat; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("emailDisplay").textContent = barang[0].email; // Ubah sesuai struktur JSON yang diterima


            modal.style.display = "block";
        }
    });
</script>



    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->




                    <!-- Scroll to top -->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>





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
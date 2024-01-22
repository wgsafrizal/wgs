<?php

include 'sesi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$koneksi = new mysqli("localhost", "root", "", "wgs");

// Periksa apakah koneksi berhasil atau tidak
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil nilai sales dari sesi.php
$sales = '$nama'; // Sesuaikan dengan variabel sesi.php yang sesuai

$query = "SELECT

          tglspk,  spk, oc, tgloc, tglpo, pocust, namacustomer,
            GROUP_CONCAT(namabarang SEPARATOR ', ') AS namabarang,
            GROUP_CONCAT(qty SEPARATOR ', ') AS qty
          FROM spk
          WHERE sales = '$nama'
          GROUP BY spk
          ORDER BY CAST(SUBSTRING(spk, LOCATE('.', spk) + 0.1) AS UNSIGNED) ASC";

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
    <title>WGS - Daftar SPK</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <!-- Select2 -->
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sertakan skrip Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link href="css/spk.css" rel="stylesheet">



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
                        <h1 class="h3 mb-0 text-gray-800">Marketing - Daftar SPK</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">Marketing</li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar SPK</li>
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
                                                    <th>Action</th>
                                                    <th>SPK</th>
                                                    <th>OC</th>
                                                    <th>Tgl</th>
                                                    <th>Customer</th>
                                              
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if ($result->num_rows > 0) {
                                                  
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td><a href='#' class='infoButton' data-spk='" . $row["spk"] . "'><i class='fa fa-info-circle' aria-hidden='true' title='Info'></i></a></td>
                    <td>" . $row["spk"] . "</td>
                    <td>" . $row["oc"] . "</td>
                    <td>" . $row["tglspk"] . "</td>
                    <td>" . $row["namacustomer"] . "</td>
           
                </tr>";
        }

        echo "</table>";
    } 


 else {
    echo "Query error: " . mysqli_error($koneksi);
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



<div id="myModal" class="modal">
  <div class="modal-content" role="document">
    <button  class="close" style="text-align:left;">&times;</button>
    <h5 style="text-align: center;">SPK</h5>
   

    <div class="rincianquotes">
      <p><strong>SPK : </strong><span id="spkDisplay"></span></p>
      <p><strong>NAMA CUSTOMER : </strong><span id="namacustomerDisplay"></span></p>
      <p><strong>OC : </strong><span id="ocDisplay"></span></p>
      <p><strong>TGL OC : </strong><span id="tglocDisplay"></span></p>
      <p><strong>PO CUST : </strong><span id="pocustDisplay"></span></p>
      <p><strong>TGL PO : </strong><span id="tglpoDisplay"></span></p>
    <br>

      <table id="barangTableDetail">
        <thead>
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
      var spk = this.dataset.spk;

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

      xhr.open('GET', 'get_spkk.php?spk=' + encodeURIComponent(spk), true);
      xhr.send();
    });
  });

  function showDetails(barang) {
    // Bersihkan isi tabel sebelum menambahkan data baru
    document.getElementById("barangTableBody").innerHTML = "";

    // Tambahkan data barang ke dalam tabel
    barang.forEach(function(item) {
      var row = document.createElement("tr");
      row.innerHTML = "<td>" + item.namabarang + "</td>  <td>" + item.qty + "</td>   <td>" + item.satuan + "</td>     " ;
      document.getElementById("barangTableBody").appendChild(row);
    });

    // Set nilai quotesDisplay dan salesDisplay
    document.getElementById("spkDisplay").textContent = barang[0].spk; // Ubah sesuai struktur JSON yang diterima
     document.getElementById("ocDisplay").textContent = barang[0].oc; // Ubah sesuai struktur JSON yang diterima
     document.getElementById("tglocDisplay").textContent = barang[0].tgloc; // Ubah sesuai struktur JSON yang diterima
     document.getElementById("pocustDisplay").textContent = barang[0].pocust; // Ubah sesuai struktur JSON yang diterima
     document.getElementById("tglpoDisplay").textContent = barang[0].tglpo; // Ubah sesuai struktur JSON yang diterima
     document.getElementById("namacustomerDisplay").textContent = barang[0].namacustomer; // Ubah sesuai struktur JSON yang diterima
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
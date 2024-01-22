<?php

include 'sesi.php';

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
    <title>WGS - Daftar Quotes</title>
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
                        <h1 class="h3 mb-0 text-gray-800">SA - Daftar Quotes</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">SA</li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Quotes</li>
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

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {

                                                        echo "<tr>";








              echo"  <td>";

        // Tombol "Info" selalu ditampilkan
        echo "<a href='#' class='infoButton' data-quotes='" . $row["quotes"] . "'><i class='fas fa-info-circle' aria-hidden='true' title='Info'></i></a>";

        // Tambahkan kondisi untuk menampilkan atau tidak tombol "ACC"
        if ($row["status"] == 'PENDING APPROVAL') {
            echo "<a href='#' class='green-button' onclick='updateStatus(\"" . $row["quotes"] . "\")'><i class='fa fa-check-circle' title='APPROVED' ></i></a>";
        }


        echo "</td>";


                                                        echo "<td>" . $row["quotes"] . "</td>";
                                                        echo "<td>" . $row["tglquotes"] . "</td>";
                                                        echo "<td>" . $row["status"] . "</td>";
                                                        echo "<td>" . $row["namacustomer"] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                                                }

                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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

                <p><strong>ID QUOTES: </strong><span id="quotesDisplay"></span></p>
                <p><strong>TGL QUOTES : </strong><span id="tglquotesDisplay"></span></p>
                <p><strong>SALES : </strong><span id="salesDisplay"></span></p>

                 <p><strong>STATUS : </strong><span id="statusDisplay"></span></p>

                <br>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="barangTableDetail">
                        <thead class="thead-light">
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
                <div class="rincianharga">
                    <div id="invoiceDetails">
                        <p><strong>Subtotal : </strong><span id="subtotalDisplay"></span></p>
                        <p><strong>PPN : </strong><span id="ppnDisplay"></span></p>
                        <p><strong>Total All : </strong><span id="totalallDisplay"></span></p>
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


            document.getElementById("statusDisplay").textContent = barang[0].status; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("salesDisplay").textContent = barang[0].sales; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("subtotalDisplay").textContent = barang[0].subtotal; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("tglquotesDisplay").textContent = barang[0].tglquotes; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("ppnDisplay").textContent = barang[0].ppn; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("totalallDisplay").textContent = barang[0].totalall; // Ubah sesuai struktur JSON yang diterima


            modal.style.display = "block";
        }
    });

    function updateStatus(quotes) {
        // Mengirim permintaan AJAX ke server
        $.ajax({
            url: 'update_status.php',
            type: 'POST',
            data: {
                quotes: quotes
            },
            success: function(response) {
                console.log(response);

                // Tambahkan logika jika perlu
                if (response === 'Success') {
                    alert('QUOTES berhasil di APPROVED');
                    window.location.href = 'daftarquotes.php';
                } else {
                    alert('Gagal mengupdate status QUOTES');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Terjadi kesalahan saat mengirim permintaan AJAX.');
            }
        });
    }
</script>








                                <div class="row">
                                    <div class="col-lg-12">
                                        <p></a></p>
                                    </div>
                                </div>

                                <!-- Modal Logout -->
                                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to logout?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                                <a href="index" class="btn btn-primary">Logout</a>
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
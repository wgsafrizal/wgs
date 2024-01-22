<?php

include 'sesi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = new mysqli("localhost", "root", "", "wgs");

// Periksa apakah koneksi berhasil atau tidak
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$query = "SELECT
oc,tgloc,
            status,
            quotes,
            sales,
            GROUP_CONCAT(namabarang SEPARATOR ', ') AS namabarang,
            GROUP_CONCAT(qty SEPARATOR ', ') AS qty,
            GROUP_CONCAT(price SEPARATOR ', ') AS price,
            GROUP_CONCAT(totalprice SEPARATOR ', ') AS totalprice,
            subtotal,namacustomer
        
          FROM oc

            WHERE status IN ('PENDING APPROVAL', 'APPROVED', 'PENDING OC','OC APPROVED', 'SPK ISSUED')

          GROUP BY status, oc
          ORDER BY
            CASE
              WHEN status = 'PENDING APPROVAL' THEN 1

              WHEN status = 'APPROVED' THEN 2

              WHEN status = 'PENDING OC' THEN 3

              WHEN status = 'OC APPROVED' THEN 4


              WHEN status = 'SPK ISSUED' THEN 5

              


              ELSE 6 
         
            END
      ";

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
    <!-- Select2 -->
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sertakan skrip Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</head>

<body id="page-top">
  
    <div id="wrapper">
       
        <?php include 'sidebar.php'; ?>
   
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                       <?php include 'topbar.php'; ?>
           

                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SA - Daftar OC</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">SA</li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar OC</li>
                        </ol>
                    </div>
                    <div class="row">
              
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
                <td>";

        // Tombol "Info" selalu ditampilkan
        echo "<a href='#' class='infoButton' data-oc='" . $row["oc"] . "'><i class='fa fa-info-circle' aria-hidden='true' title='Info'></i></a>";

        // Tambahkan kondisi untuk menampilkan atau tidak tombol "ACC"
        if ($row["status"] == 'PENDING OC') {
            echo "<a href='#' class='green-button' onclick='updateStatusOC(\"" . $row["oc"] . "\")'><i class='fa fa-check-circle' title='APPROVED' ></i></a>";
        }


        echo "</td>
              <td>" . $row["oc"] . "</td>
              <td>" . $row["tgloc"] . "</td>
              <td>" . $row["status"] . "</td>
              <td>" . $row["sales"] . "</td>
              <td>" . $row["namacustomer"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Belum Ada Data";
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
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"><b>ORDER CONFIRMATION</b></h5>
                <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>TGL OC : </strong><span id="tglocDisplay"></span></p>
                <p><strong>OC: </strong><span id="ocDisplay"></span></p>
                <p><strong> QUOTES: </strong><span id="quotesDisplay"></span></p>
                <p><strong>SALES : </strong><span id="salesDisplay"></span></p>
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p></a></p>
                                    </div>
                                </div>
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
                            </div>
           

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->







                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                    <script src="vendor/select2/dist/js/select2.min.js"></script>
                    <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="js/daftaroc.js"></script>
                    <script src="js/editmaster.js"></script>
                    <script src="js/ruang-admin.min.js"></script>
                    <script src="js/simpanmasterunits.js"></script>
                    <script src="js/get_master.js"></script>
                    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>
</html>
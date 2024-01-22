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
    <title>WGS - Master Divisi</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <h1 class="h3 mb-0 text-gray-800">SA - Master Divisi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">Warehouse</li>
                            <li class="breadcrumb-item active" aria-current="page">Master Divisi</li>
                        </ol>
                    </div>








                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <a href="#" class="btn btn-success btn-icon-split" data-toggle='modal' data-target='#exampleModalLong'>
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text"> Master Divisi</span>
                        </a>
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


                                    $query = "SELECT * FROM masterdivisi";
                                    $result = $conn->query($query);


                                    ?>


                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="dataTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Divisi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {

                                                        echo "<tr>";


                                                        echo "<td>" . $row["id"] . "</td>";
                                                        echo "<td>" . $row["divisi"] . "</td>";

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






                                <!-- Modal Long -->
                                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Master Divisi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>


                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="satuan">Divisi :</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3" id="divisi" autocomplete="off" name="divisi" placeholder="">
                                                </div>

                                            </div>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnSimpanMasterDivisi" onclick="simpanmasterdivisi()">Save changes</button>




                                            </div>
                                        </div>
                                    </div>
                                </div>




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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                    <script src="vendor/select2/dist/js/select2.min.js"></script>
                    <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="js/editmaster.js"></script>
                    <script src="js/ruang-admin.min.js"></script>
                    <script src="js/simpanmasterdivisi.js"></script>
                    <script src="js/get_master.js"></script>
                    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>
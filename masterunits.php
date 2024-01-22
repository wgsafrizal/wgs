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
    <title>WGS - Master Units</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Master Units</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">Warehouse</li>
                            <li class="breadcrumb-item active" aria-current="page">Master Units</li>
                        </ol>
                    </div>








                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <a href="#" class="btn btn-success btn-icon-split" data-toggle='modal' data-target='#exampleModalLong'>
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text"> Master Units</span>
                        </a>
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
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

                                <!-- Modal Long -->
                                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Master Units</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>


                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="satuan">Satuan :</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3" id="satuan" autocomplete="off" name="satuan" placeholder="Satuan">
                                                </div>

                                            </div>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnSimpanMaster" onclick="simpanmasterunits()">Save changes</button>




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



                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>

<script>
    
        // Gunakan Fetch API untuk mengambil data dari server
        fetch('model/mastersatuan.php')
            .then(response => response.json())
            .then(data => {
                // Manipulasi DOM untuk menambahkan data ke tabel
                const tableBody = document.getElementById('tableBody');

                // Tambahkan data ke tabel
                data.forEach(row => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `<td>${row.id}</td><td>${row.satuan}</td>`;
                    tableBody.appendChild(newRow);
                });
            })
            .catch(error => console.error('Error:', error));
</script>


                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                    <script src="vendor/select2/dist/js/select2.min.js"></script>
                    <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="js/editmaster.js"></script>
                    <script src="js/ruang-admin.min.js"></script>
                    <script src="js/simpanmasterunits.js"></script>
                    <script src="js/masterunits.js"></script>
                    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
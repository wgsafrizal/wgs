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
    <title>WGS - Master Barang Warehouse</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">


    <!-- Select2 -->
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Sertakan skrip Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



</head>

<body id="page-top">
    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Sidebar-->
        <?php include 'sidebar.php'; ?>
        <!--End Sidebar-->

        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-warning badge-counter">2</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                                            having.</div>
                                        <div class="small text-gray-500">Udin Cilok · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
                                        <div class="status-indicator bg-default"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                                            say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Jaenab · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-tasks fa-fw"></i>
                                <span class="badge badge-success badge-counter">3</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Task
                                </h6>
                                <a class="dropdown-item align-items-center" href="#">
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Design Button
                                            <div class="small float-right"><b>50%</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item align-items-center" href="#">
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Make Beautiful Transitions
                                            <div class="small float-right"><b>30%</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item align-items-center" href="#">
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Create Pie Chart
                                            <div class="small float-right"><b>75%</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
                            </div>
                        </li>








                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small"> <?php echo $nama ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>









                <div class="clearfix"></div>
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">TAMBAH MASTER BARANG</div>
                                        <hr>
                                        <form id="customerForm" method="post" action="simpanmasterbarang.php">



                                            <div class="customer-row">

                                                <input type="text" hidden name="stock" value="0">


                                                <div class="form-group">
                                                    <label for="input-6">Item Name</label>
                                                    <input type="text" autocomplete="off" class="form-control form-control-rounded" required name="namabarang[]" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-7">Item Alias</label>
                                                    <input type="text" class="form-control form-control-rounded alamat-input" autocomplete="off" required name="itemalias[]" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="input-8">Class</label>
                                                    <select class="form-control form-control-rounded alamat-input" name="class[]" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php
                                                        $conn = new mysqli('localhost', 'root', '', 'wgs');
                                                        if ($conn->connect_error) {
                                                            die("Connection failed: " . $conn->connect_error);
                                                        }
                                                        $query = "SELECT * FROM masterclass";
                                                        $result = $conn->query($query);
                                                        if ($result) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<option value='" . $row['class'] . "'>" . $row['class'] . "</option>";
                                                            }
                                                            $result->free_result();
                                                        } else {
                                                            echo "Error: " . $query . "<br>" . $conn->error;
                                                        }
                                                        $conn->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-9">Local/Import</label>
                                                    <select class="form-control form-control-rounded alamat-input" name="tipe[]" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <option value="local">Local</option>
                                                        <option value="import">Import</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="input-10">Satuan</label>
                                                    <select class="form-control form-control-rounded alamat-input" name="satuan[]" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php
                                                        $conn = new mysqli('localhost', 'root', '', 'wgs');
                                                        if ($conn->connect_error) {
                                                            die("Connection failed: " . $conn->connect_error);
                                                        }
                                                        $query = "SELECT * FROM mastersatuan";
                                                        $result = $conn->query($query);
                                                        if ($result) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<option value='" . $row['satuan'] . "'>" . $row['satuan'] . "</option>";
                                                            }
                                                            $result->free_result();
                                                        } else {
                                                            echo "Error: " . $query . "<br>" . $conn->error;
                                                        }
                                                        $conn->close();
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="input-11">Minim Stock</label>
                                                    <input type="number" class="form-control form-control-rounded alamat-input" required min="1" name="minimumstock[]" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-12">Max Stock</label>
                                                    <input type="number" class="form-control form-control-rounded alamat-input" required min="1" name="maxstock[]" placeholder="">
                                                </div>
                                            </div>
                                            <hr>
                                            <button type="button" class="btn btn-info btn-round px-5" onclick="tambahRowmaster()">Tambah Master</button>
                                            <!-- Tombol Submit untuk mengirim data form -->
                                            <button type="submit" class="btn btn-success btn-round px-5">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    function tambahRowmaster() {
                        // Create a new div element
                        var div = document.createElement('div');

                        // Get the HTML content of the customer-row
                        var customerRowHTML = document.querySelector('.customer-row').innerHTML;

                        // Add HTML content for the new row
                        div.innerHTML = customerRowHTML;

                        // Get the form element
                        var form = document.getElementById('customerForm');

                        // Insert the new row before the button (Tambah Master)
                        form.insertBefore(div, form.lastElementChild.previousElementSibling);

                        // Insert the line before the button (Tambah Master)
                        var line = document.createElement('hr');
                        form.insertBefore(line, form.lastElementChild.previousElementSibling);

                        // Clear the values in the newly added row
                        div.querySelectorAll('input, select').forEach(input => input.value = '');
                    }
                </script>


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

          <!-- Sertakan skrip Select2 -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
          <!-- Select2 -->
          <script src="vendor/select2/dist/js/select2.min.js"></script>
          <!-- Bootstrap Datepicker -->
          <!-- Bootstrap Touchspin -->
          <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
          <!-- ClockPicker -->
          <!-- RuangAdmin Javascript -->

          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

          <script src="js/ruang-admin.min.js"></script>
          <script src="js/editmaster.js"></script>
          <script src="js/simpanmaster.js"></script>

          <script src="js/get_master.js"></script>

          <script src="vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
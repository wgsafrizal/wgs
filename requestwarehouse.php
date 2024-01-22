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
  <title>WGS -Request Warehouse</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  

  <style>
  
  /* Custom CSS for Modal and Table styling */
#historyModal .modal-dialog {
    max-width: 800px; /* Lebar maksimum modul */
}

#historyModal .modal-content {
    border-radius: 10px;
}

#historyModal .modal-header {
    background-color: #3498db; /* Warna header modul */
    color: white;
    border-bottom: 2px solid #2980b9;
}

#historyModal .modal-body {
    padding: 20px;
}

#historyModal .modal-footer {
    border-top: none;
}

#historyModal .btn-secondary {
    background-color: #34495e; /* Warna tombol close */
    color: white;
}

#historyModal table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

#historyModal th,
#historyModal td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

#historyModal th {
    background-color: #3498db; /* Warna header tabel */
    color: white;
}

#historyModal tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Warna latar genap */
}




/* Custom CSS for Modal and Table styling */
#exampleModalScrollable .modal-dialog {
    max-width: 90%; /* Lebar maksimum modul */
}

#exampleModalScrollable .modal-content {
    border-radius: 10px;
}

#exampleModalScrollable .modal-header {
    background-color: #5bc0de; /* Warna header modul */
    color: white;
    border-bottom: 2px solid #46b8da;
}

#exampleModalScrollable .modal-body {
    padding: 20px;
}

#exampleModalScrollable .modal-footer {
    border-top: none;
}

#exampleModalScrollable .btn-outline-primary {
    color: #5bc0de;
    border-color: #5bc0de;
}

#exampleModalScrollable .btn-danger {
    background-color: #d9534f; /* Warna tombol delete */
    color: white;
}

#exampleModalScrollable .btn-success {
    background-color: #5cb85c; /* Warna tombol add row */
    color: white;
}

#exampleModalScrollable .btn-primary {
    background-color: #007bff; /* Warna tombol save changes */
    color: white;
}

.table-sp {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table-sp th,
.table-sp td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.table-sp th {
    background-color: #5bc0de; /* Warna header tabel */
    color: white;
}

.table-sp tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Warna latar genap */
}

    
  </style>









</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
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

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Request Items Local</h1>

            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item">Warehouse</li>
              <li class="breadcrumb-item active" aria-current="page">Request Items Local</li>
            </ol>
          </div>











          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
           

            <a href="#" class="btn btn-success btn-icon-split mr-0" data-toggle='modal' data-target='#exampleModalScrollable'>
              <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
              </span>
              <span class="text">Request Items Local</span>
            </a>

          </div>


          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                  <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "wgs";

                  $conn = new mysqli($servername, $username, $password, $dbname);

                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

            
                  $query = "
    SELECT 
        *
    FROM sp
";

                  $result = $conn->query($query);

                  ?>

                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                      <thead class="thead-light">
                        <tr>

                          <th>Action</th>
                          <th>SP</th>
                                     <th>Nama Barang</th>
                                                <th>Qty</th>
                                                           <th>Satuan</th>
                                                                      <th>Divisi</th>
                                                                                 <th>Kode Produksi</th>
                                                                                            <th>SPK</th>
                                                                                                       <th>Remarks</th>
                                                                                                                  <th>Status</th>


                 
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {


                            echo "<tr>";


                            echo "<td class='infoButton'>";
                            echo "<button class='btn btn-info btn-icon-split' onclick='showHistory(\"" . $row["nosp"] . "\")'>";
                            echo "<span class='icon text-white-50'><i class='fas fa-info-circle'></i></span>";
                            echo "<span class='text'>Info</span>";
                            echo "</button>";
                            echo "</td>";

                        




                            echo "<td>" . $row["nosp"] . "</td>";
                        
                            echo "<td>" . $row["namabarang"] . "</td>";
                            echo "<td>" . $row["qty"] . "</td>";
                            echo "<td>" . $row["satuan"] . "</td>";
                            echo "<td>" . $row["divisi"] . "</td>";
                            echo "<td>" . $row["kodeproduksi"] . "</td>"; 
                            
                            echo "<td>" . $row["spk"] . "</td>";
                            echo "<td>" . $row["remarks"] . "</td>";

                            echo "<td>" . $row["status"] . "</td>";

                            echo "</tr>";
                          }
                        } else {
                          echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                        }

                        $conn->close();
                        ?>
                      </tbody>
                    </table>
                  </div>


                </div>


                <!-- Modal untuk History Item -->

                <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">

                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="historyModalLabel"> Surat Permintaan </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">


                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>













<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Surat Permintaan </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<div class="form-group">
  
  <input readonly type="hidden" id="tglsp" name="tglsp" required="required" class="form-control">
  <span id="tglspDisplay"></span>
<script>
  var inputTanggal = document.getElementById("tglsp");
  var spanTanggal = document.getElementById("tglspDisplay");

  var tanggalHariIni = new Date().toISOString().split("T")[0];
  inputTanggal.value = tanggalHariIni;
  spanTanggal.textContent = formatDate(tanggalHariIni);

  // Function to format the date (month day, year)
  function formatDate(dateString) {
    var options = { month: 'long', day: 'numeric', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('en-US', options);
  }
</script>
</div>

          <table class="table-sp table table-bordered">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Divisi</th>
                              <th>Kode Produksi</th>
                                            <th>SPK</th>
                <th>Remarks</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <select id="namabarang" name="namabarang[]" class="namabarang" style="width: 500px; font-size: 14px; height: 34px;" required data-placeholder="Search Items Name ..." onchange="fetchKodeBarang()"></select>
                </td>


                <td>
                  <input readonly  type="text" name="satuan[]" value="" class="satuan form-control form-control-sm mb-3" style="width:60px;">
                </td>
                <td>
                  <input type="number" autocomplete="off" required class="qty form-control form-control-sm mb-3" name="qty[]" value="" min="1" max="" style="width:60px;">
                </td>



                     <td>
                  <select id="divisi" name="divisi[]" class="divisi" style="width: 80px; font-size: 14px; height: 34px;" required data-placeholder="Search Divisi ..."></select>
                </td>


<td>
                            <select id="kodeproduksi" name="kodeproduksi" class="kodeproduksi form-control select2" style="width: 100%;" required data-placeholder="Cari kodeproduksi..." onchange="carispk()"></select>
                          </td>



<td>
                            <input readonly type="text" name="nospk" autocomplete="off" class="remarks form-control form-control-sm mb-3" id="spk">
                          </td>





            <td>
  <textarea id="remarks" name="remarks[]" class="remarks form-control" style="font-size: 14px;" rows="3" required placeholder=""></textarea>
</td>

              </tr>
            </tbody>
          </table>
        </form>
      </div>

      
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-danger" onclick="deleteRow()">Delete Row</button>
<button type="button" class="btn btn-success" onclick="addRowToModal()">Add Row</button>
<button type="button" class="btn btn-primary" onclick="saveAllData()">Save changes</button>

      </div>
    </div>
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


                <!---Container Fluid-->
              </div>


              



    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->






        
          <!-- Scroll to top -->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>



          <script src="js/carispk.js"></script>
          <script src="js/simpansp.js"></script>
          <script src="js/editmaster.js"></script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
          <script src="vendor/select2/dist/js/select2.min.js"></script>
          <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
          <script src="js/ruang-admin.min.js"></script>
          <script src="vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>
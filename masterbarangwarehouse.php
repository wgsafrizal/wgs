<?php

include 'sesi.php';

            
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
$query = "

SELECT * FROM stockbarangglobal ORDER BY kodebarang;

";

                $result = $conn->query($query);
        

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
            <h1 class="h3 mb-0 text-gray-800">Master Items</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item">Warehouse</li>
              <li class="breadcrumb-item active" aria-current="page">Master Items</li>
            </ol>
          </div>
                  
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" >
                  <a href="#" class="btn btn-success btn-icon-split" data-toggle='modal' data-target='#exampleModalLong' >
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text"> Master Items</span> 
                  </a>
                </div>

    <!-- Row -->
<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable"   >
                        <thead class="thead-light">
                            <tr>
                                <th>Action</th>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Class</th>
                                <th>Unit</th>
                                <th>Type</th>
                                <th>Minimum Stock</th>
                                <th>Maximum Stock</th>
                            </tr>
                        </thead>
                        <tbody>








                            <?php

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";

                                    echo "<td><a href='#' class='btn btn-primary btn-sm' role='button' data-toggle='modal' data-target='#exampleModalScrollable' data-kodebarang='" . $row["kodebarang"] . "' data-namabarang='" . $row["namabarang"] . "' data-satuan='" . $row["satuan"] . "' data-itemalias='" . $row["itemalias"] . "' data-minimumstock='" . $row["minimumstock"] . "' data-maxstock='" . $row["maxstock"] . "' data-sn='" . $row["sn"] . "' data-tipe='" . $row["tipe"] . "' data-class='" . $row["class"] . "' onclick='openEditModal(this)'><i class='fas fa-pencil-alt'></i> Edit</a><span class='class-data' style='display:none;'>" . $row["class"] . "</span></td>";

                                    echo "<td>" . $row["kodebarang"] . "</td>";
                                    echo "<td>" . $row["namabarang"] . "</td>";
                                    echo "<td>" . $row["class"] . "</td>";
                                    echo "<td>" . $row["satuan"] . "</td>";
                                    echo "<td>" . $row["tipe"] . "</td>";
                                    echo "<td>" . $row["minimumstock"] . "</td>";
                                    echo "<td>" . $row["maxstock"] . "</td>";

                                    echo "</tr>";
                                }
                            } else {

                            }

                            // Tutup koneksi setelah selesai menggunakan database
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


<!-- Modal Tambah/Edit -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Master</h5>
                <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <!-- Form untuk Nama Barang dan Satuan -->
                <form>
                    <div class="form-group">
                        <label for="namabarangEdit">Item Name:</label>
                        <input type="text" class="form-control" id="namabarangEdit" name="namabarangEdit" placeholder="Masukkan Nama Barang">
                    </div>

                      <div class="form-group">
                        <label for="itemalias">Item Alias:</label>
                        <input type="text" class="form-control" id="itemaliasEdit" name="itemaliasEdit" placeholder="Input Item Alias">
                    </div>

                          <div class="form-group">
                        <label for="classEdit">Class:</label>
                          <select id="classEdit" name="classEdit" class="classs form-control select2" style="width: 100%;" required data-placeholder="Cari Class..." onchange=""></select>
</div>



<div class="form-group">
    <label for="satuanEdit">Unit:</label>
    <select id="satuanEdit" name="satuanEdit" class="form-control select2" style="width: 100%;" required data-placeholder="Cari Satuan..." onchange=""></select>
</div>




                          <div class="form-group">
                        <label for="snEdit">SN : </label>
                          <select id="snEdit" name="snEdit" class="snEdit form-control select2" style="width: 100%;" required data-placeholder="" onchange=""></select>
                          </div>


                          <div class="form-group">
                        <label for="tipeEdit">Tipe : </label>
                          <select id="tipeEdit" name="tipeEdit" class="snEdit form-control select2" style="width: 100%;" required data-placeholder="" onchange=""></select>
                          </div>









  <div class="form-group">
    <label for="editModalMinimumStock">Minimum Stock:</label>
    <input type="number" style="color:red;" class="form-control form-control-sm mb-3" id="minimumstockEdit" name="minimumstockEdit" placeholder="Minimum Stock">
</div>

<div class="form-group">
    <label for="editModalMaxStock">Maximum Stock:</label>
    <input type="number" style="color:blue;" class="form-control form-control-sm mb-3" id="maxstockEdit" name="maxstockEdit" placeholder="Maximum Stock">
</div>





         
            
                    <input type="hidden" id="kodebarangEdit" name="kodebarangEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
            </div>
        </div>
    </div>
  </div>
</div>

</div>

          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Master Items</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              

                <div class="modal-body">


                    <div class="form-group">
                        <label for="namabarang">Item Name :</label>
                        <input type="text" class="form-control form-control-sm  mb-3" id="namabarang" autocomplete="off" name="namabarang" placeholder="Item Name">
                    </div>


                    <div class="form-group">
                        <label for="itemalias">Item Alias :</label>
                        <input type="text" class="form-control form-control-sm  mb-3" id="itemalias" autocomplete="off" name="itemalias" placeholder="Item Alias">
                    </div>

<div class="form-group">
    <label for="sn">SN :</label>
    <select class="form-control form-control-sm mb-3" name="sn" id="sn">
        <option value="" disabled selected>Select SN</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
</div>


<div class="form-group">
    <label for="class">Class:</label>
    <select id="class" name="class" class="class form-control select2" style="width: 100%;" required data-placeholder="Select Class"></select>
</div>




<div class="form-group">
    <label for="satuan">Unit :</label>
    <select id="satuan" name="satuan" class="class form-control select2" style="width: 100%;" required data-placeholder="Select Unit"></select>
</div>


<div class="form-group">
    <label for="tipe">Type :</label>
    <select class="form-control form-control-sm mb-3" name="tipe" id="tipe">
        <option value="" disabled selected>Select Type</option>
        <option value="Local">Local</option>
        <option value="Import">Import</option>
    </select>
</div>



                    <div class="form-group">
                        <label for="minimumstock" style="color:red;">Minimum Stock :</label>
                        <input style="color:red;" type="number" class="form-control form-control-sm  mb-3 " id="minimumstock" autocomplete="off" name="minimumstock" min="1" placeholder="Minimum Stock">
                    </div>



                    <div class="form-group">
                        <label for="maxstock" style="color:blue;">Maximum Stock :</label>
                        <input style="color:blue;" type="number" class="form-control form-control-sm  mb-3" id="maxstock" autocomplete="off" name="maxstock" min="1" placeholder="Maximum Stock">
                    </div>


                        <input type="number" hidden class="form-control form-control-sm  mb-3" id="stock" autocomplete="off" value="0" name="stock" min="" placeholder="">
               
                </div>



                <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" id="btnSimpanMaster" onclick="simpanmaster()">Save changes</button>




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
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
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


<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[1, 'asc']] // Mengurutkan berdasarkan kolom kedua (indeks 1), yaitu 'kodebarang'
    });
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

  <script src="js/ruang-admin.min.js"></script>
  <script src= "js/editmaster.js"></script>
  <script src= "js/editsatuan.js"></script>
  <script src= "js/simpanmaster.js"></script>
  <script src= "js/get_master.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
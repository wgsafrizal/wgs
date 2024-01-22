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
  <title>WGS - Stock Summary</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
 <link href="css/modul.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

  <style>
  #historyModal .modal-dialog {
    width: auto;
    max-width: 80%;
  }

  .modal-header {
    background-color: #007bff;
    color: white;
    padding: 10px;
    text-align: center;
  }

  .tablehistory {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  .tablehistory th,
  .tablehistory td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
  }

  .tablehistory th {
    background-color: skyblue;
    color: white;
  }

  .tablehistory tbody tr:hover {
    background-color: #f5f5f5;
  }

  .total {
    font-weight: bold;
  }
</style>








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
           

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Stock Summary</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item">Warehouse</li>
              <li class="breadcrumb-item active" aria-current="page">Stock Summary</li>
            </ol>
          </div>











          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="#" class="btn btn-success btn-icon-split mr-0" data-toggle='modal' data-target='#exampleModalScrollable'>
              <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
              </span>
              <span class="text">Items In</span>
            </a>

            <a href="#" class="btn btn-danger btn-icon-split ml-0" data-toggle='modal' data-target='#exampleModalLong'>
              <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
              </span>
              <span class="text">Items Out</span>
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

                  // Update stock values in stockbarangglobal based on calculations
                  $updateQuery = "
    UPDATE stockbarangglobal sg
    SET
        sg.stock_in = (
            SELECT COALESCE(SUM(stock_in), 0)
            FROM barangin bi
            WHERE bi.kodebarang = sg.kodebarang
        ),
        sg.stock_out = (
            SELECT COALESCE(SUM(stock_out), 0)
            FROM barangout bo
            WHERE bo.kodebarang = sg.kodebarang
        ),
        sg.stock = (
            COALESCE(
                (SELECT SUM(stock_in) FROM barangin bi WHERE bi.kodebarang = sg.kodebarang), 0
            ) -
            COALESCE(
                (SELECT SUM(stock_out) FROM barangout bo WHERE bo.kodebarang = sg.kodebarang), 0
            )
        )
";

                  $message = "";

                  if ($conn->query($updateQuery) === TRUE) {
                    $message = "Nilai stok telah diperbarui dengan sukses!";
                  } else {
                    $message = "Error updating stock values: " . $conn->error;
                  }

                  $query = "
    SELECT 
        sg.kodebarang,
        sg.namabarang,
        sg.stock_in,
        sg.stock_out,
        sg.stock
    FROM stockbarangglobal sg
";

                  $result = $conn->query($query);

                  ?>

                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                      <thead class="thead-light">
                        <tr>

                          <th>Action</th>
                          <th>#</th>
                          <th>Item Name</th>
                          <th>Stock In</th>
                          <th>Stock Out</th>
                          <th>Stock</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {


                            echo "<tr>";


                            echo "<td class='infoButton'>";
                            echo "<button class='btn btn-info btn-icon-split' onclick='showHistory(\"" . $row["kodebarang"] . "\")'>";
                            echo "<span class='icon text-white-50'><i class='fas fa-info-circle'></i></span>";
                            echo "<span class='text'>Info</span>";
                            echo "</button>";
                            echo "</td>";




                            echo "<td>" . $row["kodebarang"] . "</td>";
                            echo "<td>" . $row["namabarang"] . "</td>";
                            echo "<td>" . $row["stock_in"] . "</td>";
                            echo "<td>" . $row["stock_out"] . "</td>";
                            echo "<td>" . $row["stock"] . "</td>";
                            

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



                <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="historyModalLabel"> History Items </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- Tempat untuk menampilkan nilai kodebarang -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle"> Items In</h5>
                        <button type="button btn-primary" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>

                      </div>
                      <div class="modal-body">
                        <form>



                          <div class="form-group">
                            <label for="tgl_in">Date :</label>
                            <input readonly type="date" id="tgl_in" name="tgl_in" required="required" class="form-control">
                            <script>
                              var inputTanggal = document.getElementById("tgl_in");
                              var tanggalHariIni = new Date().toISOString().split("T")[0];
                              inputTanggal.value = tanggalHariIni;
                            </script>
                          </div>



                          <div class="form-group">
                            <label for="namabarang">Item Name :</label>
                            <select id="namabarang" name="namabarang" class="namabarang form-control select2" style="width: 100%;" required data-placeholder="Search Items Name ..." onchange="fetchKodeBarang()"></select>
                          </div>

                          <input type="text" name="" value="" class="kodebarang form-control form-control-sm mb-3" id="kodebarang" hidden>

                          <div class="form-group">
                            <label for="satuan"> Unit : </label>
                            <input readonly type="text" name="satuan" value="" class="satuan form-control form-control-sm mb-3" id="satuan">
                          </div>

                          <div class="form-group">
                            <label for="sn">SN:</label>
                            <input type="text" name="sn" value="" readonly class="sn form-control form-control-sm mb-3" id="sn" onchange="checksn()">
                          </div>



                          <div class="form-group">
                            <label for="serialnumber">Serial Number:</label>
                            <input type="text" name="serialnumber" autocomplete="off" class="serialnumber form-control form-control-sm mb-3" id="serialnumber">
                          </div>



                          <div class="form-group">
                            <label for="stock_in">Quantity:</label>
                            <input type="number" autocomplete="off" required class="qty form-control form-control-sm mb-3" name="stock_in" value="" min="1" max="" id="stock_in">
                          </div>




                          <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <input type="text" name="remarks" autocomplete="off" class="remarks form-control form-control-sm mb-3" id="remarks">
                          </div>





                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveChangesmasuk()">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>








                <!-- Modal Long -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Item Out</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">


                        <form>

                          <div class="form-group">
                            <label for="tgl_out">Date :</label>
                            <input readonly type="date" id="tgl_out" name="tgl_out" required="required" class="form-control">
                            <script>
                              var inputTanggal = document.getElementById("tgl_out");
                              var tanggalHariIni = new Date().toISOString().split("T")[0];
                              inputTanggal.value = tanggalHariIni;
                            </script>
                          </div>
                          <div class="form-group">
                            <label for="namabarangout">Item Name:</label>
                            <select id="namabarangout" name="namabarang" class="namabarangout form-control select2" style="width: 100%;" required data-placeholder="Cari..." onchange="loadSerialNumbers()">
                            </select>
                          </div>

                          <input type="text" name="kodebarang" value="" placeholder="Kode Barang" class="kodebarangout form-control form-control-sm mb-3" id="kodebarangout" hidden>




                          <div class="form-group">
                            <label for="sn">Sn:</label>
                            <input type="text" name="sn" value="" placeholder="SN : YES/NO" class="snout form-control form-control-sm mb-3" id="snout" readonly>
                          </div>


                          <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="text" name="stock" value="" placeholder="Stock" class="snout form-control form-control-sm mb-3" id="stock" readonly>
                          </div>


                          <div class="form-group">
                            <label for="satuanout">Satuan:</label>
                            <input readonly type="text" name="satuan" value="" class="satuanout form-control form-control-sm mb-3" id="satuanout">
                          </div>



                          <div class="form-group">
                            <label for="serialnumber">Serial Number:</label>
                            <select id="serialnumberout" name="serialnumber" class="serialnumberout form-control form-control-sm mb-3">
                              <option value="" selected disabled>Pilih Serial Number</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="stock_out">Quantity:</label>
                            <input type="number" id="stock_out" autocomplete="off" required class="stock_out form-control form-control-sm mb-3" name="stock_out" value="" min="1" max="">
                          </div>



                          <div class="form-group">
                            <label for="kodeproduksi">Kode Produksi :</label>
                            <select id="kodeproduksi" name="kodeproduksi" class="kodeproduksi form-control select2" style="width: 100%;" required data-placeholder="Cari kodeproduksi..." onchange="carispk()"></select>
                          </div>




                          <div class="form-group">
                            <label for="nospk">SPK:</label>
                            <input readonly type="text" name="nospk" autocomplete="off" class="remarks form-control form-control-sm mb-3" id="spk">
                          </div>




                          <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <input type="text" name="remarks" autocomplete="off" class="remarks form-control form-control-sm mb-3" id="remarksout">
                          </div>






                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveToBarangOut()">Save changes</button>

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


                <!---Container Fluid-->
              </div>






    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->




          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>

       
          <script src="js/barangmasuk.js"></script>
          <script src="js/barangkeluar.js"></script>
          <script src="js/editmaster.js"></script>
          <script src="js/carispk.js"></script>
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
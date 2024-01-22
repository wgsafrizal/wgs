<?php
include 'sesi.php'
?>

<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'wgs');
$query_quotes = mysqli_query($koneksi, "SELECT max(quotes) as quotesTerbesar FROM quotes");
$data_quotes = mysqli_fetch_array($query_quotes);
$quotesTerbesar = $data_quotes['quotesTerbesar'];
$urutan_quotes = (int) $quotesTerbesar + 1;
$quotes = $urutan_quotes;
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
  <title>WGS - Quotes Unit</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <link href="vendor/bootstrap/css/modul.css" rel="stylesheet" type="text/css">


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
            <h1 class="h3 mb-0 text-gray-800">Marketing - Quotes</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item">Marketing</li>
              <li class="breadcrumb-item active" aria-current="page">Quotes</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <h5 class="card-title" style="color: black; text-align: center;"></h5>
                  <form id="tambahpo" action="simpanquotes.php" method="POST">
                    <div class="quotes">
                      <div style="display: flex; flex-wrap: wrap;">
                        <div style="flex: 2; margin-right: 18px;">



<p> Tgl Quotes : 
  <span id="tglquotesSpan"></span>
  <input type="hidden" type="date" id="tglquotes" name="tglquotes" required="required">

  <script>
    var inputTanggal = document.getElementById("tglquotes");
    var spanTanggal = document.getElementById("tglquotesSpan");
    var tanggalHariIni = new Date().toISOString().split("T")[0];
    inputTanggal.value = tanggalHariIni;
    spanTanggal.textContent = tanggalHariIni;
  </script>
</p>



<p> Sales :
  <span  id="sales"><?php echo $nama ?></span>
  <input type="hidden" name="sales" value="<?php echo $nama ?>">
</p>




                          <p> Status : Pending Approval
                            <input type="hidden" required type="text" placeholder="" id="status" name="status" readonly value="PENDING APPROVAL">
                          </p>

                          <p>Id Quotes :
  <span id="quotes"><?php echo $quotes ?></span>
  <input type="hidden" name="quotes" value="<?php echo $quotes ?>">
</p>


                        </div>

                        <div class="customer">

                          <p>
                            <input  list="namacustomerlist" placeholder="Customer" id="namacustomer" name="namacustomer" required autocomplete="off">
                            <datalist id="namacustomerlist">
                              <?php
                              $koneksi = mysqli_connect('localhost', 'root', '', 'wgs');
                              $query = "SELECT DISTINCT namacustomer, alamat,email FROM customer";
                              $result = mysqli_query($koneksi, $query);
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['namacustomer'] . "' data-alamat='" . $row['alamat'] . "'   data-email='" . $row['email'] . "'     >";
                              }
                              ?>
                            </datalist>

                          </p>

                          <p> <input required type="text" readonly placeholder="Alamat" id="alamat" name="alamat"> </p>

                          <p><input required type="text" readonly placeholder="Email" id="email" name="email"> </p>

                        </div>

                        <br>

                        <div class="table-responsive">

                          <br>

                          <table class="table table-shopping">
                            <thead class='thead-light'>
                              <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                                <th>Delete</th>
                              </tr>
                            </thead>

                              <tbody id="table-quotes">

                                <tr>
                                  <td class="counter">1</td>
                                  <td>
                                    <p>
                                      <input style="width:370px;" type="text" name="namabarang[]" id="namabarang" list="namabaranglist" placeholder="" autocomplete="off">
                                      <datalist id="namabaranglist">
                                        <?php
                                        $koneksi = mysqli_connect('localhost', 'root', '', 'wgs');
                                        $query = "SELECT namabarang, satuan FROM masterbarang";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value='" . $row['namabarang'] . "' data-satuan='" . $row['satuan'] . "'>";
                                        }
                                        ?>
                                      </datalist>
                                    </p>
                                  </td>



                                  <td class="qty-column">
                                    <p><input style="width: 80px;" type="number" required name="qty[]" min="1" autocomplete="off" value=""></p>
                                  </td>

                                  <td class="satuan-column">
                                    <p><input readonly style="width:120px;" type="text" name="satuan[]" value="" class="satuan" id="satuan"></p>
                                  </td>

                                  <td>
                                    <p><input type="text" required name="price[]" value="" oninput="updateTotalPrice(this)"></p>
                                  </td>

                                  <td>
                                    <p><input type="text" name="totalprice[]" readonly></p>
                                  </td>

                                  <td>
                                    <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>
                                  </td>
                                </tr>

                              </tbody>
                          </table>

                          <button type="button" class="btn btn-primary" onclick="tambahquotes()">Add</button>

                        </div>
                      </div>

                      <br>

                      <div class="container">

                        <p style="text-align: right;">
                          Subtotal : <input readonly type="text" placeholder="subtotal" id="subtotal" autocomplete="off" name="subtotal" oninput="updateFormattedSubTotal(this)" style="color: black;">
                        </p>

                        <p style="text-align: right;">
                          <textarea id="notes" placeholder="Catatan" name="notes" rows="2" cols="20" class="right-align"></textarea>
                        </p>

                        <input type="text" hidden oninput="updateFormattedPPN(this)" placeholder="ppn" id="ppn" name="ppn" style="color: black;">
                        <input type="text" hidden oninput="updateFormattedTotalAll(this)" placeholder="totalall" id="totalall" name="totalall" style="color: black;">
                      </div>
                    </div>


                    <div class="center-button" style="text-align: center;">

                      <button type="submit" class="btn btn-success">Simpan</button>
                    

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
  
  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <?php include 'scroll_to_top.php'; ?>


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
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <script src="js/quotes.js"></script>
</body>

</html>
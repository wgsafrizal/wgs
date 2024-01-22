<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>MARKETING WGS</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/wgs.png" type="image/png">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>

<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'wgs');

// Query untuk mendapatkan ID terbesar dari tabel customer
$query_id = mysqli_query($koneksi, "SELECT MAX(id) as max_id FROM customer");
$data_id = mysqli_fetch_assoc($query_id);

// Ambil nilai ID terbesar dan tambahkan 1
$idTerbesar = $data_id['max_id'];
$urutan_id = (int)$idTerbesar + 1;
$id = $urutan_id;

?>

  <style>
    /* CSS untuk menambahkan garis setelah setiap input alamat */
    .alamat-garis {
        border: none;
        height: 1px;
        background-color: #ced4da; /* Warna garis yang diinginkan */
        margin: 0;
    }

    /* CSS untuk mengatur ruang antara baris pada form */
    .customer-row {
        margin-bottom: 15px; /* Atur ruang antara setiap baris input */
    }
</style>


<!-- Pastikan jQuery dimuat sebelum menggunakan kode JavaScript yang memanfaatkannya -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  
</script>

</head>

<body class="bg-theme bg-theme1">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index">
  <h5 style="font-size: 30px; position: absolute; top: 15px; padding-left: 26px;">
    <span class="zmdi zmdi-chart"></span> <span style="color: red;">WGS</span>
</h5>


     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">

      <li>
        <a href="dashboard">
          <i class="zmdi zmdi-view-dashboard"></i> <span>DASHBOARD</span>
        </a>
      </li>

<li>
        <a href="buatquotes">
         <i class="zmdi zmdi-plus"></i> <span>TAMBAH QUOTES</span>
        </a>
      </li>
<li>
        <a href="daftarquotes">
         <i class="zmdi zmdi-view-list-alt"></i> <span>DAFTAR QUOTES</span>
        </a>
      </li>


       <li>
        <a href="tambahoc">
          <i class="zmdi zmdi-file-plus"></i>  <span>TAMBAH OC</span>
        </a>
      </li>   

        <li>
        <a href="daftaroc">
                   <i class="zmdi zmdi-file"></i> <span>DAFTAR OC</span>
        </a>
      </li>  


  
       <li>
        <a href="buatspk">
        <i class="zmdi zmdi-assignment-o"></i> <span>TAMBAH SPK</span>
        </a>
      </li>
      


      <li>
        <a href="daftarspk">
         <i class="zmdi zmdi-assignment"></i>  <span>DAFTAR SPK</span>
        </a>
      </li>
      

  


        <li>
        <a href="tambahcustomer">
   <i class="zmdi zmdi-accounts-add"></i> <span>TAMBAH CUSTOMER</span>
        </a>
      </li> 

 <li>
        <a href="customer">
         <i class="zmdi zmdi-accounts-alt"></i> <span>DAFTAR CUSTOMER</span>
        </a>
      </li> 





         <li>
        <a href="index">
          <i class="zmdi icon-power" style="color:red;"></i> <span>LOGOUT</span>
        </a>
        </li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i></a>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
    </li>
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
            <p class="user-subtitle">mccoy@example.com</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
      </ul>
    </li>
  </ul>
</nav>
</header>

<style>
  /* CSS untuk menambahkan garis setelah setiap input alamat */
  .form-group input[name="alamat"]:after {
    content: '';
    display: block;
    border-bottom: 1px solid #ced4da; /* Warna garis yang diinginkan */
    margin-top: 5px; /* Atur jarak antara input dan garis bawah */
  }
</style>


<div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid"> 
  <div class="row">
   <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">TAMBAH CUSTOMER</div>
            <hr>
            <form id="customerForm" method="post" action="simpancustomer.php">
                 <div class="customer-row">
 <!-- ... other form fields ... -->


    <input type="text" hidden  class="form-control form-control-rounded" name="id" value="<?php echo $id; ?>" placeholder="">

<div class="form-group">
    <label for="input-6">Nama Customer</label>
    <input type="text" class="form-control form-control-rounded" name="namacustomer" placeholder="">
</div>
<div class="form-group">
    <label for="input-7">Alamat</label>
    <input type="text" class="form-control form-control-rounded alamat-input" name="alamat" placeholder="">
</div>
<div class="form-group">
    <label for="input-8">Phone Office</label>
    <input type="text" class="form-control form-control-rounded alamat-input" name="telp" placeholder="">
</div>
<div class="form-group">
    <label for="input-9">Email</label>
    <input type="text" class="form-control form-control-rounded alamat-input" name="email" placeholder="">
</div>

<div class="form-group">
    <label for="input-10">NPWP</label>
    <input type="text" class="form-control form-control-rounded alamat-input" name="npwp" placeholder="">
</div>

<div class="form-group">
    <label for="input-11">Contact Person</label>
    <input type="text" class="form-control form-control-rounded alamat-input" name="cp[]" placeholder="">
</div>
<div class="form-group">
    <label for="input-12">Mobile</label>
    <input type="text" class="form-control form-control-rounded alamat-input" name="hp[]" placeholder="">
</div>



    </div>
<script>
 function tambahRowCP() {
    // Create a new div element
    var div = document.createElement('div');

    // Add HTML content for the new row
    div.innerHTML = '<div class="form-group">' +
                        '<label for="input-11">Contact Person</label>' +
                        '<input type="text" class="form-control form-control-rounded alamat-input" name="cp[]" placeholder="">' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label for="input-12">Mobile</label>' +
                        '<input type="text" class="form-control form-control-rounded alamat-input" name="hp[]" placeholder="">' +
                    '</div>'


                    





                    ;

    // Append the new row to the form
    document.getElementById('customerForm').appendChild(div);
}

</script>

<button type="button" class="btn btn-info btn-round px-5" onclick="tambahRowCP()">Tambah CP</button>


   
    <br>
    <br>

   
    <hr class="alamat-garis">
</div>

<div class="modal-footer" style="margin-left: 0px; border: none;">
        <div class="col-auto">
            <button type="submit" class="btn btn-success btn-round px-5">Simpan</button>
        </div>
    </div>
</form>

         </div>
         </div>
      </div>
    </div><!--End Row-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>

</body>
</html>
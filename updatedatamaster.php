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

$kodebarang = $_POST['kodebarang'];
$namabarang = $_POST['namabarang'];
$satuan = $_POST['satuan'];
$itemalias = $_POST['itemalias'];
$minimumstock = $_POST['minimumstock'];
$maxstock = $_POST['maxstock'];
$tipe = $_POST['tipe'];
$classValue = $_POST['classValue'];
$snData = $_POST['sn'];

// Assuming that the class column is named 'class' in your database
$sql_stock = "UPDATE stockbarangglobal 
              SET namabarang='$namabarang', satuan='$satuan', itemalias='$itemalias', 
                  minimumstock='$minimumstock', maxstock='$maxstock', tipe='$tipe', 
                  class='$classValue', sn='$snData' 
              WHERE kodebarang='$kodebarang'";

$sql_master = "UPDATE masterbarang 
               SET namabarang='$namabarang', satuan='$satuan', itemalias='$itemalias', 
                   minimumstock='$minimumstock', maxstock='$maxstock', tipe='$tipe', 
                   class='$classValue', sn='$snData' 
               WHERE kodebarang='$kodebarang'";

if (mysqli_query($conn, $sql_stock) && mysqli_query($conn, $sql_master)) {
    echo "Data updated successfully";
} else {
    echo "Error updating data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

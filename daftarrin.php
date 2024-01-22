<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = new mysqli("localhost", "root", "", "wgs");

// Periksa apakah koneksi berhasil atau tidak
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$query = "SELECT * FROM barangin";

$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='table'>
            <tr>

            <th>Tgl</th>

        <th>Nama Barang</th>

            <th>Stock_In</th>





            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              
              <td>" . $row["tgl_in"] . "</td>

              <td>" . $row["namabarang"] . "</td>



              <td>" . $row["stock_in"] . "</td>
            
            </tr>";
    }

    echo "</table>";
} else {
    echo "Belum Ada Data";
}

mysqli_close($koneksi);
?>


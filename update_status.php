<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah quotes ada dalam data POST
    if (isset($_POST['quotes'])) {
        $quotes = $_POST['quotes'];

        // Lakukan koneksi ke database
        $koneksi = new mysqli("localhost", "root", "", "wgs");

        // Periksa apakah koneksi berhasil atau tidak
        if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
        }

        // Lakukan query untuk mengupdate status menjadi 'APPROVED'
        $queryUpdate = "UPDATE quotes SET status = 'APPROVED' WHERE quotes = '$quotes'";
        $resultUpdate = mysqli_query($koneksi, $queryUpdate);

        if ($resultUpdate) {
            echo "Success";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

        mysqli_close($koneksi);
    } else {
        echo "Error: Missing required parameter 'quotes'";
    }
} else {
    echo "Error: Invalid request method";
}
?>

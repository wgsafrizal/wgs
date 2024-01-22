<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah oc ada dalam data POST
    if (isset($_POST['oc'])) {
        $oc = $_POST['oc'];

        // Lakukan koneksi ke database
        $koneksi = new mysqli("localhost", "root", "", "wgs");

        // Periksa apakah koneksi berhasil atau tidak
        if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
        }

        // Update status di tabel 'oc'
        $queryUpdateOC = "UPDATE oc SET status = 'OC APPROVED' WHERE oc = '$oc'";
        $resultUpdateOC = mysqli_query($koneksi, $queryUpdateOC);

        // Update status di tabel 'quotes'
        $queryUpdateQuotes = "UPDATE quotes SET status = 'OC APPROVED' WHERE oc = '$oc'";
        $resultUpdateQuotes = mysqli_query($koneksi, $queryUpdateQuotes);

        if ($resultUpdateOC && $resultUpdateQuotes) {
            echo "Success";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

        mysqli_close($koneksi);
    } else {
        echo "Error: Missing required parameter 'oc'";
    }
} else {
    echo "Error: Invalid request method";
}
?>

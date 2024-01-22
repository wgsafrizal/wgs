<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "wgs"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil quotes dari parameter GET
$quotes = $_GET['quotes'];

// Query untuk mengambil semua namabarang yang terkait dengan quotes
$sql = "SELECT * FROM quotes WHERE quotes = '$quotes'";
$result = $conn->query($sql);

// Menyimpan hasil query dalam bentuk array
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "Data tidak ditemukan atau terjadi kesalahan pada query: " . $sql;
}

// Menutup koneksi ke database
$conn->close();

// Mengirim data sebagai respons JSON
header('Content-Type: application/json');
echo json_encode(['barang' => $data]);

?>

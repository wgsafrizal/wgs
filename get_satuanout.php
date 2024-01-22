<?php
// get_satuanout.php

// Fungsi koneksi ke database (gantilah dengan informasi koneksi sesuai dengan server Anda)
$host = 'localhost';
$username = '';
$password = '';
$database = 'wgs';

$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mendapatkan nilai namabarang dari parameter GET
$namabarang = isset($_GET['namabarang']) ? $_GET['namabarang'] : '';

// Inisialisasi respons default
$response = array('satuan' => '');

// Membuat query untuk mendapatkan informasi satuan dari tabel stockbarangglobal
$query = "SELECT satuan FROM stockbarangglobal WHERE namabarang = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $namabarang);
$stmt->execute();
$stmt->bind_result($satuan);

// Mengambil nilai satuan jika ada hasil dari query
if ($stmt->fetch()) {
    $response['satuan'] = $satuan;
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

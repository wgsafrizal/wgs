<?php
// File: model/mastersatuan/get_mastersatuan.php

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

// Query untuk mengambil data dari tabel mastersatuan
$query = "SELECT id, satuan FROM mastersatuan";
$result = $conn->query($query);

// Inisialisasi array untuk menyimpan data
$data = array();

// Jika query berhasil
if ($result) {
    // Ambil hasil dalam bentuk array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Bebaskan hasil query
    $result->free_result();
}

// Tutup koneksi database
$conn->close();

// Mengembalikan data dalam bentuk JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

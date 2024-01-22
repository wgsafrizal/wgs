<?php
// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data masterbarang
$sql = "SELECT  namabarang FROM masterbarang";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data
$data = array();

// Ambil data dan masukkan ke dalam array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'text' => $row['namabarang']
        );
    }
}

// Tutup koneksi
$conn->close();

// Keluarkan data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

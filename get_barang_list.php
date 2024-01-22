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

// Query untuk mendapatkan data dari tabel masterbarang
$query = "SELECT namabarang FROM masterbarang";
$result = $conn->query($query);

// Format hasil untuk Select2
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'id' => $row['namabarang'],
        'text' => $row['namabarang']
    );
}

// Tampilkan data dalam format JSON
echo json_encode($data);

// Tutup koneksi database
$conn->close();
?>

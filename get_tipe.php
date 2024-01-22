<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wgs");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Tangkap parameter pencarian
$term = isset($_GET['term']) ? $_GET['term'] : '';

// Query ke database untuk mendapatkan namabarang
if (empty($term)) {
    $query = "SELECT tipe FROM mastertipe";
} else {
    $query = "SELECT tipe FROM mastertipe WHERE tipe LIKE '%$term%'";
}

$result = $koneksi->query($query);

// Siapkan hasil pencarian namabarang sebagai array
$barang = array();
while ($row = $result->fetch_assoc()) {
    $barang[] = array('id' => $row['tipe'], 'text' => $row['tipe']);
}

// Keluarkan hasil pencarian namabarang sebagai JSON
echo json_encode($barang);

// Tutup koneksi
$koneksi->close();
?>

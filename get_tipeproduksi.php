<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wgs");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Tangkap parameter pencarian
$term = isset($_GET['term']) ? $_GET['term'] : '';
// Query ke database untuk mendapatkan tipeproduksi unik
if (empty($term)) {
    $query = "SELECT DISTINCT tipeproduksi FROM bom";
} else {
    $query = "SELECT DISTINCT tipeproduksi FROM bom WHERE tipeproduksi LIKE '%$term%'";
}

$result = $koneksi->query($query);

// Siapkan hasil pencarian namabarang sebagai array
$bom = array();
while ($row = $result->fetch_assoc()) {
    $bom[] = array('id' => $row['tipeproduksi'], 'text' => $row['tipeproduksi']);
}

// Keluarkan hasil pencarian namabarang sebagai JSON
echo json_encode($bom);

// Tutup koneksi
$koneksi->close();
?>

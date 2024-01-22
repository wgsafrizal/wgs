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
    $query = "SELECT DISTINCT namacomponent FROM bomcomponent";
} else {
    $query = "SELECT DISTINCT namacomponent FROM bomcomponent WHERE namacomponent LIKE '%$term%'";
}

$result = $koneksi->query($query);

// Siapkan hasil pencarian namabarang sebagai array
$bom = array();
while ($row = $result->fetch_assoc()) {
    $bom[] = array('id' => $row['namacomponent'], 'text' => $row['namacomponent']);
}

// Keluarkan hasil pencarian namabarang sebagai JSON
echo json_encode($bom);

// Tutup koneksi
$koneksi->close();
?>

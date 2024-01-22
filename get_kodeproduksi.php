<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wgs");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Tangkap parameter pencarian
$term = isset($_GET['term']) ? $_GET['term'] : '';

// Query ke database untuk mendapatkan kodeproduksi
if (empty($term)) {
    $query = "SELECT kodeproduksi FROM produksi";
} else {
    $query = "SELECT kodeproduksi FROM produksi WHERE kodeproduksi LIKE '%$term%'";
}

$result = $koneksi->query($query);

// Inisialisasi array untuk menyimpan distrint kodeproduksi
$distinctKodeProduksi = array();

// Loop melalui hasil query
while ($row = $result->fetch_assoc()) {
    // Tambahkan nilai kodeproduksi ke array jika belum ada
    if (!in_array($row['kodeproduksi'], $distinctKodeProduksi)) {
        $distinctKodeProduksi[] = $row['kodeproduksi'];
    }
}

// Siapkan hasil pencarian kodeproduksi sebagai array
$data = array();
foreach ($distinctKodeProduksi as $kodeProduksi) {
    $data[] = array('id' => $kodeProduksi, 'text' => $kodeProduksi);
}

// Keluarkan hasil pencarian kodeproduksi sebagai JSON
echo json_encode($data);

// Tutup koneksi
$koneksi->close();
?>

<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wgs");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Tangkap parameter tipeproduksi
$namacomponent = isset($_GET['namacomponent']) ? $_GET['namacomponent'] : '';

// Query ke database untuk mendapatkan namabarang dan qty berdasarkan tipeproduksi
$query = "SELECT * FROM bomcomponent WHERE namacomponent = '$namacomponent'";
$result = $koneksi->query($query);

// Siapkan hasil pencarian sebagai array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array('namabarang' => $row['namabarang'], 'qty' => $row['qty']);
}

// Keluarkan hasil pencarian sebagai JSON
echo json_encode($data);

// Tutup koneksi
$koneksi->close();
?>

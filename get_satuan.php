<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wgs");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Periksa apakah parameter namabarang telah terkirim
if (isset($_GET['namabarang'])) {
    // Tangkap parameter namabarang
    $namabarang = $_GET['namabarang'];

    // Query ke database untuk mendapatkan nilai satuan
    $querySatuan = "SELECT satuan FROM masterbarang WHERE namabarang = '$namabarang'";
    $resultSatuan = $koneksi->query($querySatuan);

    // Periksa apakah query berhasil dijalankan
    if ($resultSatuan) {
        // Ambil data satuan dari hasil query
        $dataSatuan = $resultSatuan->fetch_assoc();
        $satuan = $dataSatuan['satuan'];

        // Keluarkan hasil nilai satuan sebagai JSON
        echo json_encode(['satuan' => $satuan]);
    } else {
        // Handle kesalahan jika query gagal dijalankan
        echo json_encode(['error' => 'Gagal mengambil data satuan']);
    }
} else {
    // Tangkap parameter pencarian
    $term = $_GET['term'];

    // Query ke database untuk mendapatkan namabarang
    $query = "SELECT namabarang FROM stockbarangglobal WHERE namabarang LIKE '%$term%'";
    $result = $koneksi->query($query);

    // Siapkan hasil pencarian namabarang sebagai array
    $barang = array();
    while ($row = $result->fetch_assoc()) {
        $barang[] = array('id' => $row['namabarang'], 'text' => $row['namabarang']);
    }

    // Keluarkan hasil pencarian namabarang sebagai JSON
    echo json_encode($barang);
}

// Tutup koneksi
$koneksi->close();
?>

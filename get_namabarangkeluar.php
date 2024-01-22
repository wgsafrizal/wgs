<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wgs");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Tangkap parameter pencarian
$term = isset($_GET['term']) ? $_GET['term'] : '';

// Query ke database untuk mendapatkan namabarang dari barangin dan stock dari stockbarangglobal
if (empty($term)) {
    $query = "SELECT DISTINCT s.namabarang, s.stock
              FROM stockbarangglobal s
              INNER JOIN barangin b ON s.kodebarang = b.kodebarang
              WHERE b.status IS NULL AND s.stock > 0";
} else {
    $query = "SELECT DISTINCT s.namabarang, s.stock
              FROM stockbarangglobal s
              INNER JOIN barangin b ON s.kodebarang = b.kodebarang
              WHERE s.namabarang LIKE ? AND b.status IS NULL AND s.stock > 0";
}

// Membuat prepared statement
$stmt = $koneksi->prepare($query);

// Cek apakah prepared statement berhasil dibuat
if ($stmt) {
    // Binding parameter hanya jika query mencakup prepared statement
    if (!empty($term)) {
        // Tambahkan binding parameter untuk prepared statement
        $term = "%$term%";
        $stmt->bind_param("s", $term);
    }

    // Eksekusi query
    $stmt->execute();

    // Dapatkan hasil query
    $result = $stmt->get_result();

    // Siapkan hasil pencarian namabarang sebagai array
    $barang = array();
    while ($row = $result->fetch_assoc()) {
        $barang[] = array('id' => $row['namabarang'], 'text' => $row['namabarang']);
    }

    // Keluarkan hasil pencarian namabarang sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($barang);
    
    // Tutup prepared statement
    $stmt->close();
} else {
    // Jika prepared statement gagal dibuat, tampilkan pesan error
    die("Error in query: " . $koneksi->error);
}

// Tutup koneksi
$koneksi->close();
?>

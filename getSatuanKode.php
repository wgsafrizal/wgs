<?php
// getSatuanKode.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai namabarang dari request POST
    $namabarang = $_POST['namabarang'];

    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "wgs"; // Ganti dengan nama database Anda

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mengambil satuan dan kodebarang dari tabel stockbarangglobal berdasarkan namabarang
    $sql = "SELECT satuan, kodebarang FROM stockbarangglobal WHERE namabarang = ?";
    
    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $namabarang);
    $stmt->execute();
    $stmt->bind_result($satuan, $kodebarang);
    $stmt->fetch();
    $stmt->close();

    // Menutup koneksi database
    $conn->close();

    // Mengembalikan data dalam format JSON
    $result = array(
        'satuan' => $satuan,
        'kodebarang' => $kodebarang
    );
    echo json_encode($result);
} else {
    // Jika bukan metode POST, kembalikan respons kosong atau sesuai kebutuhan
    echo json_encode([]);
}
?>

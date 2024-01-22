<?php
// getdata.php

// Konfigurasi koneksi ke database
$host = 'localhost';
$dbname = 'wgs';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil nama barang dari parameter GET
    $namabarang = $_GET['namabarang'];

    // Lakukan query untuk mendapatkan data dari tabel stockbarangglobal
    $stmt = $conn->prepare("SELECT kodebarang, satuan FROM stockbarangglobal WHERE namabarang = :namabarang");
    $stmt->bindParam(':namabarang', $namabarang, PDO::PARAM_STR);
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Format hasil query ke dalam bentuk yang sesuai
    $response = array(
        'kodebarang' => $result['kodebarang'],
        'satuan' => $result['satuan']
    );

    // Set header response sebagai JSON
    header('Content-Type: application/json');

    // Keluarkan hasil dalam format JSON
    echo json_encode($response);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>

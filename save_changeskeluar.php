<?php

// Hubungkan ke database (sesuaikan dengan konfigurasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari request POST
$tgl_out = $_POST['tgl_out'];
$namabarang = $_POST['namabarang'];
$kodebarang = $_POST['kodebarang'];
$satuan = $_POST['satuan'];
$stock_out = $_POST['stock_out'];
$serialnumber = $_POST['serialnumber'];
$kodeproduksi = $_POST['kodeproduksi'];
$nospk = $_POST['nospk'];
$stock = $_POST['stock'];
$remarks = $_POST['remarks'];



// Gunakan prepared statement dengan bind_param
$sql_insert = "INSERT INTO barangout (tgl_out, namabarang, kodebarang, satuan, stock_out, serialnumber, kodeproduksi, nospk, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssssssiss", $tgl_out, $namabarang, $kodebarang, $satuan, $stock_out, $serialnumber, $kodeproduksi, $nospk, $remarks);

// Eksekusi statement INSERT
if ($stmt_insert->execute()) {
    // Jika INSERT berhasil dan serialnumber memiliki nilai, update status di tabel barangin menjadi 'out'
    if (!empty($serialnumber)) {
        $sql_update = "UPDATE barangin SET status = 'out' WHERE serialnumber = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("s", $serialnumber);

        // Eksekusi statement UPDATE
        if ($stmt_update->execute()) {
            echo "Data berhasil disimpan ke tabel barangout dan status di tabel barangin telah diupdate.";
        } else {
            echo "Error updating status: " . $stmt_update->error;
        }

        // Tutup statement UPDATE
        $stmt_update->close();
    } else {
        echo "Serial Number tidak valid, tidak dapat melakukan update status.";
    }
} else {
    echo "Error inserting data: " . $stmt_insert->error;
}


// Tutup statement INSERT dan koneksi ke database
$stmt_insert->close();
$conn->close();

?>

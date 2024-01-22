<?php
// simpanmasterunit.php

// Fungsi untuk melakukan koneksi ke database
function connectToDatabase() {
    $host = "localhost"; // Ganti sesuai dengan host database Anda
    $username = "root"; // Ganti sesuai dengan username database Anda
    $password = ""; // Ganti sesuai dengan password database Anda
    $database = "wgs"; // Ganti sesuai dengan nama database Anda

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    return $conn;
}

// Menerima data dari permintaan AJAX
$data = json_decode(file_get_contents("php://input"));

// Menyimpan data ke database
function saveToDatabase($satuan) {
    $conn = connectToDatabase();

    // Melakukan sanitasi input untuk mencegah serangan SQL injection
    $satuan = $conn->real_escape_string($satuan);

    // Query untuk menyimpan data ke tabel masterunit
    $query = "INSERT INTO mastersatuan (satuan) VALUES ('$satuan')";

    if ($conn->query($query) === TRUE) {
        $response = ["status" => "success", "message" => "Data berhasil disimpan"];
    } else {
        $response = ["status" => "error", "message" => "Error: " . $conn->error];
        error_log("Error: " . $conn->error);
    }

    $conn->close();

    return $response;
}

// Menanggapi permintaan AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    // Memastikan bahwa data satuan dikirimkan
    if (isset($data->satuan)) {
        $satuan = $data->satuan;

        // Menyimpan data ke database
        $result = saveToDatabase($satuan);

        // Mengembalikan respons ke frontend
        echo json_encode($result);
    } else {
        // Jika data tidak lengkap
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    }
} else {
    // Jika metode permintaan tidak diizinkan
    echo json_encode(["status" => "error", "message" => "Metode permintaan tidak diizinkan"]);
}
?>

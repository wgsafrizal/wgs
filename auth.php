<?php

// Fungsi untuk membuat koneksi ke database
function createConnection() {
    $host = "localhost";
    $dbname = "wgs";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Fungsi untuk membuat pengguna baru
function createUser($nama, $username, $hashedPassword) {
    $conn = createConnection();

    try {
        $stmt = $conn->prepare("INSERT INTO user (nama, username, password) VALUES (?, ?, ?)");
        $stmt->execute([$nama, $username, $hashedPassword]);
        return true;
    } catch (PDOException $e) {
        // Anda dapat melakukan penanganan kesalahan yang sesuai di sini
        // Misalnya, mencetak pesan kesalahan atau mengembalikan false
        die("Error creating user: " . $e->getMessage());
        // return false;
    } finally {
        $conn = null; // Tutup koneksi setelah pengguna dibuat atau kesalahan terjadi
    }
}

function getUser($conn, $username) {
    try {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching user: " . $e->getMessage());
    }
}

?>
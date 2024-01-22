<?php
session_start();

 $nama = $_SESSION['authenticated_user']['nama'];


// Set timeout sesi menjadi 1 menit (60 detik)
$sessionTimeout = 600;

// Cek apakah sesi pengguna ada
if (!isset($_SESSION['authenticated_user'])) {
    // Jika tidak, alihkan ke halaman indeks
    header("Location: index.php");
    exit;
}

// Cek waktu terakhir akses pengguna
if (isset($_SESSION['last_activity'])) {
    $currentTime = time();
    $lastActivity = $_SESSION['last_activity'];

    // Jika lebih dari 1 menit yang lalu, alihkan ke halaman indeks
    if (($currentTime - $lastActivity) > $sessionTimeout) {
        session_unset();
        session_destroy();
        header("Location: index");
        exit;
    }
}

// Perbarui waktu terakhir akses pengguna
$_SESSION['last_activity'] = time();
?>

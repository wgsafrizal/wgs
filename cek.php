<?php 

session_start();

require 'auth.php';

// Proses login jika ada pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi.';
    } else {
        $conn = createConnection();
        $user = getUser($conn, $username);

        if ($user && password_verify($password, $user['password'])) {
            // Sesuaikan sesi dengan informasi pengguna
            $_SESSION['authenticated_user'] = [
            	
                'username' => $username,
                'password' => $password,
                'nama' => $user['nama'],
            ];

            // Alihkan ke halaman dashboard
            header("Location: dashboard");
            exit;
        } else {
            $error = 'Username atau password salah.';
        }

        $conn = null; // Tutup koneksi setelah pengguna diotentikasi atau kesalahan terjadi
    }
}

?>
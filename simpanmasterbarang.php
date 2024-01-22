<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lakukan koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'wgs');

    // Periksa koneksi database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Loop through the arrays of data
    for ($i = 0; $i < count($_POST['namabarang']); $i++) {
        // Ambil data dari formulir
        $stock = $_POST['stock'];
        $namabarang = $_POST['namabarang'][$i];
        $itemalias = $_POST['itemalias'][$i];
        $class = $_POST['class'][$i];
        $tipe = $_POST['tipe'][$i];
        $satuan = $_POST['satuan'][$i];
        $minimumstock = $_POST['minimumstock'][$i];
        $maxstock = $_POST['maxstock'][$i];

        // Query untuk memeriksa apakah nama barang sudah ada
        $checkQuery = "SELECT namabarang FROM masterbarang WHERE namabarang = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $namabarang);
        $checkStmt->execute();
        $checkStmt->store_result();

        // Jika nama barang sudah ada, tampilkan konfirmasi
        if ($checkStmt->num_rows > 0) {
            echo '<script>';
            echo 'if (confirm("Nama Barang ' . $namabarang . ' sudah ada. tambah Nama Barang yang lain")) {';
            echo '  window.location.href = "tambahmaster.php";';
            echo '} else {';
            echo '  window.location.href = "tambahmaster.php";'; // Ubah ke halaman yang sesuai jika tidak ingin melanjutkan
            echo '}';
            echo '</script>';
            exit();
        }

        // Lakukan query untuk menyimpan data ke dalam tabel masterbarang
        $sql = "INSERT INTO masterbarang (stock, namabarang, itemalias, class, tipe, satuan, minimumstock, maxstock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Periksa apakah query berhasil dijalankan
        if ($stmt) {
            // Bind parameter ke query
            $stmt->bind_param("ssssssss", $stock, $namabarang, $itemalias, $class, $tipe, $satuan, $minimumstock, $maxstock);

            // Eksekusi query
            $stmt->execute();

            // Tutup statement
            $stmt->close();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Tutup koneksi database
    $conn->close();

    // Tampilkan pesan alert dan alihkan ke halaman daftarmastergudang.php
    echo '<script>';
    echo 'alert("Data berhasil disimpan");';
    echo 'window.location.href = "daftarmastergudang.php";';
    echo '</script>';
    exit();
} else {
    // Redirect jika data tidak dikirimkan melalui metode POST
    header("Location: halaman_error.php");
    exit();
}
?>

<?php
// Koneksi ke basis data (sesuaikan dengan konfigurasi Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil quotes dari parameter GET
$quotes = $_GET['quotes'];

// Query untuk mendapatkan informasi dari tabel quotes
$sql = "SELECT * FROM quotes WHERE quotes = '$quotes'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Data quotes yang akan dikirim ke frontend
    $dataInfo = array(
        'sales' => $row['sales'],
        'namacustomer' => $row['namacustomer'],
        'email' => $row['email'],
        'alamat' => $row['alamat'],


        'ppn' => $row['ppn'],


        'totalall' => $row['totalall'],

        'subtotal' => $row['subtotal'],

    );

    // Query untuk mendapatkan data barang berdasarkan quotes
    $sqlBarang = "SELECT * FROM quotes WHERE quotes = " . $row['quotes'];
    $resultBarang = $conn->query($sqlBarang);

    $dataBarangOC = array();
    while ($rowBarang = $resultBarang->fetch_assoc()) {
        // Tambahkan data barang ke array
        $dataBarang[] = array(
            'namabarang' => $rowBarang['namabarang'],
            'qty' => $rowBarang['qty'],
            'satuan' => $rowBarang['satuan'],
            'price' => $rowBarang['price'],
            'totalprice' => $rowBarang['totalprice'],
          
        );
    }

    // Sertakan data barang ke dalam dataInfo
    $dataInfo['dataBarangOC'] = $dataBarang;

    // Kembalikan data dalam format JSON
    echo json_encode($dataInfo);
} else {
    echo json_encode(array('error' => 'Quotes not found'));
}

// Tutup koneksi
$conn->close();
?>

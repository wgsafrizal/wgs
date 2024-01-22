<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "wgs";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['kodebarang'])) {
    $kodebarang = $_POST['kodebarang'];

    // Menggunakan parameterized query untuk mencegah SQL injection
    $query = "SELECT 
                s.namabarang,
                b.tgl_in AS tgl,
                b.stock_in,
                b.remarks AS remarksin,
                0 AS stock_out,
                '' AS remarksout,
                '' AS kodeproduksi  -- Kolom kosong untuk tabel barangin
              FROM stockbarangglobal s
              LEFT JOIN barangin b ON s.kodebarang = b.kodebarang
              WHERE s.kodebarang = ? AND (b.tgl_in IS NOT NULL OR b.stock_in IS NOT NULL OR b.remarks IS NOT NULL)
                
              UNION ALL

              SELECT 
                s.namabarang,
                bo.tgl_out AS tgl,
                0 AS stock_in,
                '' AS remarksin,
                bo.stock_out,
                bo.remarks AS remarksout,
                bo.kodeproduksi  -- Kolom kodeproduksi dari tabel barangout
              FROM stockbarangglobal s
              LEFT JOIN barangout bo ON s.kodebarang = bo.kodebarang
              WHERE s.kodebarang = ? AND (bo.tgl_out IS NOT NULL OR bo.stock_out IS NOT NULL OR bo.remarks IS NOT NULL)
              ORDER BY tgl DESC";

    // Persiapkan statement dengan parameter
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $kodebarang, $kodebarang); // "i" adalah tipe data integer

    // Eksekusi statement
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Memeriksa apakah ada data yang ditemukan
    if ($result->num_rows > 0) {
        // Menampilkan nama barang di atas tabel
        $row = $result->fetch_assoc();
        echo "<h5 class='modal-title' id='historyModalLabel'>" . $row['namabarang'] . "</h5>";
        echo "<br>";

        // Menampilkan data dalam format yang diinginkan, misalnya menggunakan tabel HTML
        echo "<table class='table tablehistory'>";
        echo "<thead><tr><th>Tanggal</th><th>Stock In</th><th>Remarks In</th><th>Stock Out</th><th>Remarks Out</th><th>Kode Produksi</th></tr></thead>";
        echo "<tbody>";

        $totalStockIn = 0;
        $totalStockOut = 0;

        do {
            // Menampilkan hasil pada baris tabel
            echo "<tr><td>" . $row['tgl'] . "</td><td>" . $row['stock_in'] . "</td><td>" . $row['remarksin'] . "</td><td>" . $row['stock_out'] . "</td><td>" . $row['remarksout'] . "</td><td>" . $row['kodeproduksi'] . "</td></tr>";

            // Menghitung total stock_in dan stock_out
            $totalStockIn += $row['stock_in'];
            $totalStockOut += $row['stock_out'];
        } while ($row = $result->fetch_assoc());

        echo "</tbody>";
        echo "</table>";
        echo "<br>";

        // Menampilkan Total Stock In, Total Stock Out, dan Total Stock di bawah tabel
        echo "<p>Total Stock In: " . $totalStockIn . "</p>";
        echo "<p>Total Stock Out: " . $totalStockOut . "</p>";

        // Menampilkan Total Stock (stock_in - stock_out) di bawah tabel
        $totalStock = $totalStockIn - $totalStockOut;
        echo "<p>Total Stock: " . $totalStock . "</p>";
    } else {
        echo "Data tidak ditemukan.";
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Kode barang tidak diterima.";
}

// Tutup koneksi
$conn->close();
?>

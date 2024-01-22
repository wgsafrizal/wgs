<?php
// Pastikan data POST tersedia
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mendapatkan data dari formulir

    $status=$_POST['status'];
    $quotes = $_POST['quotes'];
    $tglquotes = $_POST['tglquotes'];
    $notes = $_POST['notes'];
    $subtotal = $_POST['subtotal'];
    $namabarang = $_POST['namabarang'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];
    $price = $_POST['price'];
    $totalprice = $_POST['totalprice'];
    $ppn = $_POST['ppn'];
  $namacustomer = $_POST['namacustomer'];
    $alamat = $_POST['alamat'];
      $email = $_POST['email'];
  
      $sales = $_POST['sales'];
    $totalall = $_POST['totalall'];


 // Validasi data
if (

    empty($status) ||
    empty($quotes) || 
    empty($tglquotes) || 
    empty($sales) || 
    empty($notes) || 
    empty($subtotal) || 
    empty($namabarang) || 
    empty($qty) || 
    empty($satuan) || 
    empty($price) || 
    empty($totalprice) || 
    empty($ppn) || 
    empty($totalall) || 
    empty($namacustomer) || 
    empty($alamat) || 


    empty($email)
) {
    // Your code here
  echo "<script>
        alert('Data masih ada yang kosong');
        window.location.href = 'buatquotes';
     </script>";
    exit;
}


    // Lakukan koneksi ke database
    $koneksi = mysqli_connect('localhost', 'root', '', 'wgs');
    if (!$koneksi) {
        die('Koneksi Gagal: ' . mysqli_connect_error());
    }

    // Contoh query insert dengan prepared statement, sesuaikan dengan struktur tabel Anda
    $query = "INSERT INTO quotes (sales,status,quotes, tglquotes, notes, namabarang, qty, satuan, price, totalprice, subtotal,ppn,totalall,namacustomer,alamat,email)
              VALUES (?,?, ?,  ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?)";

    // Mempersiapkan statement
  // Mempersiapkan statement
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    // Loop untuk multiple items
    foreach ($namabarang as $key => $value) {
        $namabarangItem = $value;
        $qtyItem = $qty[$key];
        $satuanItem = $satuan[$key];
        $priceItem = $price[$key];
        $totalpriceItem = $totalprice[$key];

        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "ssssssssssssssss",$sales, $status,$quotes, $tglquotes, $notes, $namabarangItem, $qtyItem, $satuanItem, $priceItem, $totalpriceItem, $subtotal, $ppn, $totalall, $namacustomer, $alamat, $email );

        // Eksekusi statement
        mysqli_stmt_execute($stmt);
    }
    echo "<script>
        alert('Quotes Berhasil di buat');
        window.location.href = 'daftarquotesmarketing';
     </script>";

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}


    // Tutup koneksi
    mysqli_close($koneksi);
} else {
    echo "Metode HTTP tidak valid.";
}
?>

<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'wgs');

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $spk = $_POST['spk'];
    $oc = $_POST['oc'];
    $tglspk = $_POST['tglspk'];
    $pocust = $_POST['pocust'];
    $alamat = $_POST['alamat'];
    $namacustomer = $_POST['namacustomer'];
    $sales = $_POST['sales'];

    // Ambil data detail barang
    $namabarang = $_POST['namabarang'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];

    for ($i = 0; $i < count($namabarang); $i++) {
        // Pastikan indeks ke-i ada di dalam array
        if (isset($namabarang[$i]) && isset($qty[$i]) && isset($satuan[$i])) {
            // Jika satuan adalah "unit" dan qty lebih dari 1, loop untuk membuat spk.1, spk.2, dst.
            if (strtoupper($satuan[$i]) == "UNIT" && $qty[$i] > 1) {
                for ($j = 0; $j < $qty[$i]; $j++) {
                    $current_spk = $spk . '.' . ($j + 1);

                    // Ganti bagian ini untuk menyimpan qty sebagai "1/n"
                    $qty_fraction = "1/" . $qty[$i];

                    $query_quotes = "INSERT INTO spk (spk, sales, oc, tglspk, pocust, alamat, namacustomer, namabarang, qty, satuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($koneksi, $query_quotes);
                    mysqli_stmt_bind_param($stmt, 'ssssssssis', $current_spk, $sales, $oc, $tglspk, $pocust, $alamat, $namacustomer, $namabarang[$i], $qty_fraction, $satuan[$i]);

                    $result_quotes = mysqli_stmt_execute($stmt);

                    if (!$result_quotes) {
                        die("Query gagal: " . mysqli_error($koneksi));
                    }

                    mysqli_stmt_close($stmt);
                }
            } else {
                // Jika satuan bukan "unit" atau qty tidak lebih dari 1, gunakan nilai qty yang diberikan
                if (strtoupper($satuan[$i]) != "UNIT" || $qty[$i] == 1) {
                    $current_spk = $spk . ''; // Tambah .0 untuk indeks 0

                    $query_quotes = "INSERT INTO spk (spk, sales, oc, tgloc, pocust, tglpo, namacustomer, namabarang, qty, satuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($koneksi, $query_quotes);
                    $qtyValue = intval($qty[$i]);
                    mysqli_stmt_bind_param($stmt, 'ssssssssis', $current_spk, $sales, $oc, $tgloc, $pocust, $tglpo, $namacustomer, $namabarang[$i], $qtyValue, $satuan[$i]);

                    $result_quotes = mysqli_stmt_execute($stmt);

                    if (!$result_quotes) {
                        die("Query quotes gagal: " . mysqli_error($koneksi));
                    }

                    mysqli_stmt_close($stmt);
                }
            }
        }
    }

    // Update status di tabel "oc" menjadi "SPK"
    $status_update_query_oc = "UPDATE oc SET status = 'SPK ISSUED' WHERE oc = ?";
    $status_update_stmt_oc = mysqli_prepare($koneksi, $status_update_query_oc);
    mysqli_stmt_bind_param($status_update_stmt_oc, 's', $oc);
    $result_status_update_oc = mysqli_stmt_execute($status_update_stmt_oc);

    if (!$result_status_update_oc) {
        die("Query oc gagal: " . mysqli_error($koneksi));
    }

    mysqli_stmt_close($status_update_stmt_oc);

    // Update status di tabel "quotes" menjadi "SPK"
    $status_update_query_quotes = "UPDATE quotes SET status = 'SPK ISSUED' WHERE oc = ?";
    $status_update_stmt_quotes = mysqli_prepare($koneksi, $status_update_query_quotes);
    mysqli_stmt_bind_param($status_update_stmt_quotes, 's', $oc);
    $result_status_update_quotes = mysqli_stmt_execute($status_update_stmt_quotes);

    if (!$result_status_update_quotes) {
        die("Query quotes gagal: " . mysqli_error($koneksi));
    }

    mysqli_stmt_close($status_update_stmt_quotes);

    // Redirect ke halaman daftar SPK setelah berhasil
    header("Location: daftarspk.php");
    exit();
}

mysqli_close($koneksi);
?>

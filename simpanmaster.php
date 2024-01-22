<?php
// simpanmaster.php

$servername = "localhost";
$username = "root";
$password = "";
$database = "wgs";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$namabarang = $_POST['namabarang'];
$itemalias = $_POST['itemalias'];
$classValue = $_POST['classValue'];
$satuanValue = $_POST['satuanValue'];
$tipe = $_POST['tipe'];
$minimumstock = $_POST['minimumstock'];
$maxstock = $_POST['maxstock'];
$stock = $_POST['stock'];
$sn = $_POST['sn'];

$checkDuplicateQuery = "SELECT namabarang FROM masterbarang WHERE namabarang = '$namabarang'";
$result = $conn->query($checkDuplicateQuery);

if ($result->num_rows > 0) {
    echo json_encode(["status" => "DataSudahAda", "namabarang" => $namabarang]);
} else {
    $sqlMaster = "INSERT INTO masterbarang (namabarang, itemalias, class, satuan, tipe, minimumstock, maxstock, stock, sn)
                  VALUES ('$namabarang', '$itemalias', '$classValue', '$satuanValue', '$tipe', $minimumstock, $maxstock, $stock, '$sn')";

    if ($conn->query($sqlMaster) === TRUE) {
        // Jika data berhasil dimasukkan ke masterbarang, tambahkan ke stockbarangglobal
        $sqlStockGlobal =  "INSERT INTO stockbarangglobal (namabarang, itemalias, class, satuan, tipe, minimumstock, maxstock, stock, sn)
                  VALUES ('$namabarang', '$itemalias', '$classValue', '$satuanValue', '$tipe', $minimumstock, $maxstock, $stock, '$sn')";

        if ($conn->query($sqlStockGlobal) === TRUE) {
            echo json_encode(["status" => "DataBerhasilDisimpan"]);
        } else {
            echo json_encode(["status" => "DataGagalDisimpan", "message" => $conn->error]);
        }
    } else {
        echo json_encode(["status" => "DataGagalDisimpan", "message" => $conn->error]);
    }
}

$conn->close();
?>

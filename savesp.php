<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data sent by AJAX
$jsonData = json_decode($_POST['data'], true);

// Iterate through each row of data and insert into the database
foreach ($jsonData as $row) {

    $tglsp = $row['tglsp'];
    $namabarang = $row['namabarang'];
    $satuan = $row['satuan'];
    $qty = $row['qty'];
    $divisi = $row['divisi'];
    $remarks = $row['remarks'];

    // Customize the SQL query based on your table structure
    $sql = "INSERT INTO sp(tglsp,namabarang, satuan, qty, divisi, remarks) VALUES ('$tglsp','$namabarang', '$satuan', '$qty', '$divisi', '$remarks')";

    if ($conn->query($sql) !== true) {
        echo "Error: " . $sql . "<br>" . $conn->error;
 
    }
}

// Close the database connection
$conn->close();

// Send a response back to the client
echo "Data saved successfully";
?>

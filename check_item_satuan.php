<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the namabarang value from the POST request
$satuan = $_POST['satuan'];

// Prepare and execute the SQL query to check the existence of namabarang
$sql = "SELECT COUNT(*) AS count FROM mastersatuan WHERE satuan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $satuan);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

// Send response based on the existence of namabarang
if ($count > 0) {
    echo "exists";
} else {
    echo "not_exists";
}

// Close the database connection
$conn->close();
?>

<?php
// get_kodebarang.php

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

// Get the selected namabarang
$namabarang = $_GET['namabarang'];

// Query to get kodebarang and sn based on namabarang
$query = "SELECT kodebarang, sn FROM masterbarang WHERE namabarang = ?";

// Prepare and bind the SQL statement
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $namabarang);

// Execute the statement
$stmt->execute();

// Bind the result
$stmt->bind_result($kodebarang, $sn);

// Fetch the result
$stmt->fetch();

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();

// Return the result as JSON
echo json_encode(['kodebarang' => $kodebarang, 'sn' => $sn]);
?>

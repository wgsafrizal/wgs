<?php
// Replace these with your actual database connection details
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

// Check if namabarang is set and not empty
if (isset($_GET['kodeproduksi']) && !empty($_GET['kodeproduksi'])) {
    // Get the selected namabarang
    $selectedKodeProduksi = $_GET['kodeproduksi'];

    // TODO: Replace the following lines with your actual database query
    $query = "SELECT * FROM produksi WHERE kodeproduksi = '$selectedKodeProduksi'";

    // Execute the database query
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $data = $result->fetch_assoc();

        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // If no matching record found, return an empty response
        echo json_encode(array());
    }
} else {
    // If namabarang is not set or empty, return an empty response
    echo json_encode(array());
}

// Close the database connection
$conn->close();
?>

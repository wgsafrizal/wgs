<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wgs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['namabarang']) && !empty($_GET['namabarang'])) {
    $selectedNamabarang = $conn->real_escape_string($_GET['namabarang']);  // Use real_escape_string to prevent SQL injection

    $query = "SELECT * FROM barangin WHERE namabarang = '$selectedNamabarang'";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(array());
        }
    } else {
        // Handle query execution errors
        echo json_encode(array('error' => $conn->error));
    }
} else {
    echo json_encode(array());
}

$conn->close();
?>

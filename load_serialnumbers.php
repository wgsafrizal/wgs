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
if (isset($_GET['namabarang']) && !empty($_GET['namabarang'])) {
    $selectedNamabarang = $conn->real_escape_string($_GET['namabarang']);



$query = "
SELECT 
    s.kodebarang,
    s.satuan,
    s.sn,
    s.stock,
    b.serialnumber
FROM 
    stockbarangglobal s
LEFT JOIN 
    barangin b ON s.kodebarang = b.kodebarang
WHERE 
    s.namabarang = '$selectedNamabarang' AND b.status IS NULL
ORDER BY
    s.stock ;
";







$result = $conn->query($query);

    if ($result) {
        $data = array();

        while ($row = $result->fetch_assoc()) {

            $data['stock'][] = $row['stock'];

            $data['sn'][] = $row['sn'];
            $data['serialnumbers'][] = $row['serialnumber'];
            $data['kodebarang'] = $row['kodebarang'];
            $data['satuan'] = $row['satuan'];
        }

        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // If an error occurs, return an empty response
        echo json_encode(array());
    }
} else {
    // If namabarang is not set or empty, return an empty response
    echo json_encode(array());
}

// Close the database connection
$conn->close();
?>

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

// Set the charset to UTF-8
$conn->set_charset("utf8mb4");

// Check if the data is sent using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $kodebarang = mysqli_real_escape_string($conn, $_POST['kodebarang']);
    $tgl_in = mysqli_real_escape_string($conn, $_POST['tgl_in']);
    $namabarang = mysqli_real_escape_string($conn, $_POST['namabarang']);
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    $stock_in = mysqli_real_escape_string($conn, $_POST['stock_in']);
    $serialnumber = mysqli_real_escape_string($conn, $_POST['serialnumber']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
  $sn = mysqli_real_escape_string($conn, $_POST['sn']);

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Prepare and bind the SQL statement to insert data into barangin
        $stmtInsert = $conn->prepare("INSERT INTO barangin (kodebarang, tgl_in, namabarang, satuan, stock_in, serialnumber, remarks,sn) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
        $stmtInsert->bind_param("ssssisss", $kodebarang, $tgl_in, $namabarang, $satuan, $stock_in, $serialnumber, $remarks,$sn);

        // Execute the insert statement
        if ($stmtInsert->execute()) {
            // Commit transaction
            $conn->commit();

            // Send a success response back to the front end
            echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
        } else {
            // Rollback transaction on insert error
            $conn->rollback();
            throw new Exception('Error inserting data');
        }

        // Close the insert statement
        $stmtInsert->close();
    } catch (Exception $e) {
        // Send an error response back to the front end
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    // Close the connection
    $conn->close();
} else {
    // Send an error response if the request method is not POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>

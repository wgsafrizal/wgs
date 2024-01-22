<?php
include('db.php');

try {
    // Fetch satuan from the database
    $sql = "SELECT satuan FROM mastersatuan";
    $result = $conn->query($sql);

    if (!$result) {
        $error_message = "Query failed: " . $conn->errorInfo()[2];
        header('Content-Type: application/json');
        echo json_encode(array('error' => $error_message));
    } else {
        $satuan = array();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $satuan[] = $row['satuan'];
            }

            // Return JSON response with satuan
            header('Content-Type: application/json');
            echo json_encode($satuan);
        } else {
            $message = "No data found in the 'mastersatuan' table.";
            header('Content-Type: application/json');
            echo json_encode(array('message' => $message));
        }
    }
} catch (PDOException $e) {
    $error_message = "PDO Exception: " . $e->getMessage();
    header('Content-Type: application/json');
    echo json_encode(array('error' => $error_message));
} finally {
    $conn = null; // Close the connection
}
?>

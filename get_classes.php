<?php
include('db.php');

try {
    // Fetch classes from the database
    $sql = "SELECT class FROM masterclass";
    $result = $conn->query($sql);

    if (!$result) {
        $error_message = "Query failed: " . $conn->errorInfo()[2];
        header('Content-Type: application/json');
        echo json_encode(array('error' => $error_message));
    } else {
        $classes = array();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $classes[] = $row['class'];
            }

            // Return JSON response with classes
            header('Content-Type: application/json');
            echo json_encode($classes);
        } else {
            $message = "No data found in the 'masterclass' table.";
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

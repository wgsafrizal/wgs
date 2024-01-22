<?php
// Database connection details
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "wgs";

// Create a connection to the database
$your_db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check the connection
if (!$your_db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the divisi value from the POST request
    $divisi = $_POST['divisi'];

    // Validate the divisi value (add your validation logic if needed)
    if (empty($divisi)) {
        echo "Invalid divisi value.";
        exit;
    }

    // Perform the database insertion (replace these lines with your actual database insertion code)
    $query = "INSERT INTO masterdivisi (divisi) VALUES ('$divisi')";
    $result = mysqli_query($your_db_connection, $query);

    if ($result) {
        // Return success message if the insertion is successful
        echo "Divisi saved successfully!";
    } else {
        // Return an error message if the insertion fails
        echo "Error in the query: " . mysqli_error($your_db_connection);
    }

    // Close the database connection
    mysqli_close($your_db_connection);
} else {
    // Handle cases where the request method is not POST
    echo "Invalid request method.";
}
?>

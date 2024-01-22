<!-- history.php -->

<?php
// Define your database connection details for the WGS database
$wgs_db_host = "localhost";
$wgs_db_user = "root";
$wgs_db_password = "";
$wgs_db_name = "wgs";

// Create a connection to the WGS database
$wgs_db_connection = mysqli_connect($wgs_db_host, $wgs_db_user, $wgs_db_password, $wgs_db_name);

// Check the connection
if (!$wgs_db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the SP value from the POST request (replace 'YOUR_SP_VALUE' with the actual parameter name)
$nosp = $_POST['nosp'];

// Query to get history information based on SP value
$query = "SELECT tglsp, nosp, namabarang, qty FROM sp WHERE nosp = '$nosp'";

$result = mysqli_query($wgs_db_connection, $query);

// Check if the query was successful
if ($result) {
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Date</th>';
    echo '<th>SP</th>';
    echo '<th>Item Name</th>';
    echo '<th>Quantity</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['tglsp'] . '</td>';
        echo '<td>' . $row['nosp'] . '</td>';
        echo '<td>' . $row['namabarang'] . '</td>';
        echo '<td>' . $row['qty'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    mysqli_free_result($result);
} else {
    echo '<p>Error in the query: ' . mysqli_error($wgs_db_connection) . '</p>';
}

// Close the database connection
mysqli_close($wgs_db_connection);
?>

<?php
include "../db_connect.php";
$clientId = $_GET['customerId'];
echo $clientId . '$clientId';
$sql = "DELETE FROM clients WHERE client_id = $clientId";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "deleted client with id" . $clientId;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$conn->close();


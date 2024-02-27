<?php
include "../db_connect.php";
$clientId = $_GET['customerId'];
$clientName = $_GET['customerName'];
echo $clientId.' '.$clientName;
$sql = "UPDATE clients SET client_name='$clientName' WHERE client_id=$clientId";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "edited client with id" . $clientId;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$conn->close();


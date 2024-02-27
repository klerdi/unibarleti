<?php
include "../db_connect.php";
$name = $_GET['name'];
$sql = "INSERT INTO clients (client_name) VALUES ('$name')";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "added" . $name;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$conn->close();
?>


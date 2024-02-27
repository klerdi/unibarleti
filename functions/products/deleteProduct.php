<?php
include "../../db_connect.php";
$id = $_GET['id'];
$sql = "DELETE FROM products WHERE product_id = $id";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "deleted product with id " . $id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$conn->close();


<?php
include "../../db_connect.php";
$name = $_GET['name'];
$desc = $_GET['desc'];
$price = $_GET['price'];
$sql = "INSERT INTO products (product_name, description, unit_price) VALUES ('$name','$desc','$price')";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "added " . $name;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$conn->close();
?>


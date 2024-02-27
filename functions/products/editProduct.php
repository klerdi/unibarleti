<?php
include "../../db_connect.php";
$id = $_GET['id'];
$name = $_GET['name'];
$desc = $_GET['desc'];
$price = $_GET['price'];
$sql = "UPDATE products SET ";
// Check if name is not empty
if (!empty($name)) {
    $sql .= "product_name='$name', ";
}
if (!empty($desc)) {
    $sql .= "description='$desc', ";
}
if (!empty($price)) {
    $sql .= "unit_price='$price', ";
}
$sql = rtrim($sql, ", ");
$sql .= " WHERE product_id=$id";
echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "edited product with id " . $id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();


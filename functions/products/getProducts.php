<?php
include "../../db_connect.php";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
$conn->close();
// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);

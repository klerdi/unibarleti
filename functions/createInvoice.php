<?php
include "../db_connect.php";
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);
$products = $data['products'];
$customerId = $data['details']['customer'];
$total = 0;

// Loop through each product
foreach ($products as $product) {
    // Calculate subtotal for each product (quantity * price)
    $subtotal = $product['quantity'] * $product['price'];
    // Add subtotal to total
    $total += $subtotal;
}

// Output total price
echo "Total price: $" . $total;
//var_dump($products);
// Now you can access the data like this:
//$key1 = $data['key1'];
//$key2 = $data['key2'];

//$sql = "INSERT INTO products (product_name, description, unit_price) VALUES ('$name','$desc','$price')";

$sql = "INSERT INTO invoices (client_id, total_amount)
VALUES ($customerId, $total);
";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    $last_insert_id = mysqli_insert_id($conn);
    $sql2 = "INSERT INTO invoiceProducts (invoice_id, product_id, quantity) VALUES ";
    $values = [];
    foreach ($products as $row) {
        var_dump($row['id']);
        var_dump($row['quantity']);
        $values[] = "(" . $last_insert_id . ", " . $row['id'] . ", " . $row['quantity'] . ")";
        var_dump($values);


    }
    $sql2 .= implode(", ", $values);
    if ($conn->query($sql2) === TRUE) {
        echo 'hyri';

    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close connection
$conn->close();
?>


<?php
include "db_connect.php";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$conn->close();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title> Customers </title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<style>
    table {
        margin: auto;
        border-collapse: collapse;
        border-spacing: 0;
        width: 80%;
        border: 1px solid #323232;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background: #323232
    }

    .modal {
        position: absolute;
        background: #000000b8;
        width: -moz-available;
        width: -webkit-fill-available;
        height: 100dvh;
        top: 0;
        left: 0;
    }

    .innerModal {
        max-width: 20rem;
        height: fit-content;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
    }
</style>
</head>
<body style="padding: 3rem">
<a class="glassCard goBack" href="dashboard.php"><</a> <br>
<div class="flex">
    <button class="glassButton button" onclick="showCreate()" style="max-width: 20rem;">Add new Product</button>
</div>
<div id="createProductModal" style="display: none" class="modal">
    <div class="innerModal glassCard pd2">
        <h2>Add Product</h2>
        <input type="text" id="product_name" placeholder="Product Name">
        <input type="text" id="product_desc" placeholder="Product Description">
        <input type="text" id="product_price" placeholder="Product Price">
        <div style="display: flex; gap:5px">
            <button class="glassButton button" onclick="addProduct()">Save</button>
            <button class="glassButton button" onclick="closeModal('createProductModal')">Cancel</button>
        </div>
    </div>
</div>
<div id="editProductModal" style="display: none" class="modal">
    <div class="innerModal glassCard pd2">
        <h2 id="editingProduct" style="font-size: 20px;"></h2>
        <input type='text' id='newName' placeholder='New Product Name'>
        <input type='text' id='newDesc' placeholder='New Product Description'>
        <input type='text' id='newPrice' placeholder='New Product Price'>
        <div style="display: flex; gap:5px">
            <button class="glassButton button" onclick="saveEditProduct()">Save</button>
            <button class="glassButton button" onclick="closeModal('editProductModal')">Cancel</button>
        </div>
    </div>
</div>
<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>More</th>
        </tr>
        <?php
        // Check if there are any customers in the database
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $id = $row["product_id"];
                echo "<tr>
                        <td>" . $id . "</td>
                        <td>" . $row["product_name"] . "</td>
                        <td>" . $row["description"] . "</td>
                        <td>" . $row["unit_price"] . "</td>
                        <td style=''>
                            <button class='glassButton' style='font-size: 15px' onclick='deleteProduct($id)'>X</button>
                            <button class='glassButton' style='font-size: 15px' onclick='editProduct($id)'>edit</button>
                        </td>
                     </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No Products found</td></tr>";
        }
        ?>
    </table>
</div>
<script>
    let editingId = null
    let xhttp = new XMLHttpRequest();

    function showCreate() {
        document.getElementById("createProductModal").style.display = "grid";
    }

    function addProduct() {
        let name = document.getElementById("product_name").value;
        let desc = document.getElementById("product_desc").value;
        let price = document.getElementById("product_price").value;
        xhttp.open("GET", `functions/products/addProduct.php?name=${name}&&desc=${desc}&&price=${price}`, true);
        xhttp.send();
        // closeModal('createProductModal')
    }

    function deleteProduct(value) {
        // Define the PHP script to be called and the type of request (GET or POST)
        xhttp.open("GET", `functions/products/deleteProduct.php?id=${value}`, true);
        xhttp.send();
    }

    function editProduct(value) {
        editingId = value
        document.getElementById("editProductModal").style.display = "grid";
        document.getElementById("editingProduct").innerHTML = "You are editing Product with id " + value;

    }

    function saveEditProduct() {
        let name = document.getElementById("newName").value;
        let desc = document.getElementById("newDesc").value;
        let price = document.getElementById("newPrice").value;
        let param = `id=${editingId}&&name=${name}&&desc=${desc}&&price=${price}`
        console.log(param,'editing')
        xhttp.open("GET", `functions/products/editProduct.php?${param}`, true);
        xhttp.send();
    }

    function closeModal(val) {
        document.getElementById(val).style.display = "none";
    }
</script>

</body>
</html>

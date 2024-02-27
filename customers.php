<?php
include "db_connect.php";
$sql = "SELECT * FROM clients";
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
    <button class="glassButton button" onclick="showCreate()" style="max-width: 20rem;">Add new Customer</button>
</div>
<div id="createCustomerModal" style="display: none" class="modal">
    <div class="innerModal glassCard pd2">
        <h2>Add Customer</h2>
        <input type="text" id="client_name" placeholder="Customer Name">
        <div style="display: flex; gap:5px">
            <button class="glassButton button" onclick="addCustomer()">Save</button>
            <button class="glassButton button" onclick="closeModal('createCustomerModal')">Cancel</button>
        </div>
    </div>
</div>
<div id="editCustomerModal" style="display: none" class="modal">
    <div class="innerModal glassCard pd2">
        <h2 id="editingCustomer" style="font-size: 20px;"></h2>
        <input type='text' id='newName' placeholder='New Customer Name'>
        <div style="display: flex; gap:5px">
            <button class="glassButton button" onclick="saveEditCustomer()">Save</button>
            <button class="glassButton button" onclick="closeModal('editCustomerModal')">Cancel</button>
        </div>
    </div>
</div>
<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>More</th>
        </tr>
        <?php
        // Check if there are any customers in the database
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $id = $row["client_id"];
                echo "<tr>
                        <td>" . $id . "</td>
                        <td>" . $row["client_name"] . "</td>
                        <td style=''>
                            <button class='glassButton' style='font-size: 15px' onclick='deleteCustomer($id)'>X</button>
                            <button class='glassButton' style='font-size: 15px' onclick='editCustomer($id)'>edit</button>
                        </td>
                     </tr>";
            }
        } else {
            echo "<tr><td colspan='1'>No customers found</td></tr>";
        }
        ?>
    </table>
</div>
<script>
    let editingId = null

    function showCreate() {
        document.getElementById("createCustomerModal").style.display = "grid";
    }

    function addCustomer() {
        var name = document.getElementById("client_name").value;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "functions/addCustomer.php?name=" + name, true);
        xhttp.send();
        closeModal('createCustomerModal')
    }

    function deleteCustomer(value) {
        var xhttp = new XMLHttpRequest();
        // Define the PHP script to be called and the type of request (GET or POST)
        xhttp.open("GET", "functions/deleteCustomer.php?customerId=" + value, true);
        xhttp.send();
    }

    function editCustomer(value) {
        editingId = value
        document.getElementById("editCustomerModal").style.display = "grid";
        document.getElementById("editingCustomer").innerHTML = "You are editing customer with id " + value;

    }

    function saveEditCustomer() {
        var name = document.getElementById("newName").value;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "functions/editCustomer.php?customerId=" + editingId + "&&customerName=" + name, true);
        xhttp.send();
    }

    function closeModal(val) {
        document.getElementById(val).style.display = "none";
    }
</script>

</body>
</html>

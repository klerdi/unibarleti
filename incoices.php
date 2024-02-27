<?php
include "db_connect.php";
$sql = "SELECT * FROM invoices";
$result = $conn->query($sql);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> invoices </title>
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

    .container{
        padding: 2rem;
        justify-content: center;
        display: flex;
        max-width: 16rem;
        margin: 1rem auto;
        gap: 20px;
    }
</style>
<body>
<a class="glassCard goBack" href="dashboard.php"><</a> <br>
<button class="button glassButton" style="display: block" onclick="createInvoiceShow()" id="creInv">Create new Invoice</button>
<div id="invTable">
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>total</th>
                <th>More</th>
            </tr>
            <?php
            // Check if there are any customers in the database
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $id = $row["invoice_id"];
                    echo "<tr>
                        <td>" . $id . "</td>
                        <td>" . $row["client_id"] . "</td>
                        <td>" . $row["total_amount"] . "</td>
                        <td style=''>
                            <button class='glassButton' style='font-size: 15px' onclick='deleteProduct($id)'>X</button>
                            <button class='glassButton' style='font-size: 15px' onclick='editProduct($id)'>edit</button>
                        </td>
                     </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No invoices found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<div style="display: none;" id="addPro">
    <div style="display: flex; justify-content: center; gap: 5rem;">
        <div id="result"></div>
        <div style="width: 24rem">
            <div style="position: fixed;">
                <button class="button glassButton" onclick="addProduct()" style="margin-top:1rem">Add Product</button>
                <h2>Customer:</h2>
                <select id="customersDiv" name="customersDiv"></select>
                <button class="button glassButton" onclick="createInvoice()">Create</button>
            </div>
        </div>
    </div>
</div>
<script>
    let products= [], customers= [], xhttp = new XMLHttpRequest(); arr = [], di ='', options='', custOptions='',dataProd =[];
    function printArray(){
        document.getElementById("result").innerHTML = di
    }
    // printArray()
    function addProduct(){
        console.log(dataProd)
        let data = {
            "name":`${dataProd[0].product_name}`,
            "quantity":1
        };
        let idx = arr.push(data)-1;
        di += `<div class="container glassCard">
                <select id="products${idx}" name="products${idx}">
                    ${options}
                </select>
               <input type="number" min="1" id="qty${idx}" name="qty${idx}" value="1"/>
               </div>`
        printArray();
    }
    function getProdArr(){
        let datap = []
        console.log(arr,'sssssssaaalll')
        for (let i = 0; i < arr.length; i++) {
            var el = document.getElementById(`products${i}`);
            var text = el.options[el.selectedIndex].innerHTML;
            let x= {
                "price": el.value,
                "quantity":document.getElementById(`qty${i}`).value,
                "id":text
            };
            datap.push(x)
        }
        console.log(datap,'getProdArrgetProdArrgetProdArr')
        return datap
    };
    function getCustomers(){
        xhttp.open("GET", 'functions/customers/getCustomers.php', true);
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                 data = JSON.parse(xhttp.responseText);
                customers = data
                for (let i = 0; i < customers.length; i++) {
                    custOptions += `<option value="${customers[i].client_id}">${customers[i].client_name}</option>`
                }
                document.getElementById("customersDiv").innerHTML = custOptions
            }
        };
        xhttp.send();
    };
    function createInvoiceShow() {
        xhttp.open("GET", 'functions/products/getProducts.php', true);
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                // Parse JSON response
                dataProd = JSON.parse(xhttp.responseText);

                // Display data
                products= dataProd
                for (let i = 0; i < products.length; i++) {
                    options += `<option value="${products[i].unit_price}" label="${products[i].product_name}">${products[i].product_id}</option>`
                }
                addProduct()
                getCustomers()
            }
        };
        xhttp.send();
        document.getElementById("addPro").style.display = "grid";
        document.getElementById("creInv").style.display = "none";
        document.getElementById("invTable").style.display = "none";
    };
    function createInvoice(){
        let prodArray = getProdArr()
        let a = document.getElementById("customersDiv").value
        let dataToSend = {
            details: {
                customer: a,
            },
            products: prodArray
        };
        var jsonData = JSON.stringify(dataToSend);
        fetch('functions/createInvoice.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: jsonData
        }).then(response => {
            // Handle the response here if needed
        });

    }
</script>
</body>
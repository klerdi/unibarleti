<?php
session_start();
include "db_connect.php";
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title> Dashboard </title>
        <link rel="stylesheet" type="text/css" href="main.css"> </head>
    <body>
    <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php" class="glassButton button">Logout</a>
    <div class="flex center">
    <a class="glassCard pd2 smallPages" href="customers.php">Customers</a>
    <a class="glassCard pd2 smallPages" href="products.php">Products</a>
    <a class="glassCard pd2 smallPages" href="incoices.php">Invoices</a>
    </div>
    </body>
    </html>
    <?php
}
else{
  header("Location:index.php");
  exit();
}
?>
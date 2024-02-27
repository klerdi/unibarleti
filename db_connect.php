<?php

    // Database connection parameters
    $servername = "localhost"; // Replace with your MySQL host
    $username = "root"; // Replace with your MySQL username
    $password = "Klerd123!"; // Replace with your MySQL password
    $database = "testmanagement"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



<?php
    // Connection variables
    $servername = "db.bucomputing.uk";
    $username = "s5117801";
    $password = "iFnLYzRcWFTn9ghpkRWt4YdxnvUujjeo";

    // Create new connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully!";
?>
<?php
# Connect to the MySQL database with MySQLi
function connect($dbHost, $dbName, $dbUsername, $dbPassword, $dbPort) {
    $db = new mysqli( // instantiate new mysqli database connection
        $dbHost,
        $dbUsername,
        $dbPassword,
        $dbName,
        $dbPort
    );

    if ($db -> connect_error) { // test for connection failure
        die(
            "Cannot connect to database: \n"
            . $db -> connect_error . "\n" // output connection error
            . $db -> connect_errno // output error number
        );
    }

    return $db; // return connection if successfully connected
};

function fetchAll(mysqli $db) {
    $data = [];
    $sql = "SELECT * FROM `sample_info`;";
    $result = $db -> query($sql);

    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    return $data;
}
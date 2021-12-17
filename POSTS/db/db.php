<?php

/**
 * Connect to the MySQL database with MySQLi and run Query
 * @param string $query Query to apply to SQL server
 * @param bool $debug Optional flag to print debug info to webpage
 * @param string $dbHost Definition of MySQL server host
 * @param string $dbName Definition of MYSQL server database name
 * @param string $dbUsername Definition of MySQL username to use
 * @param string $dbPassword Definition of MySQL user password to use
 * @param int $dbPort Definition of MySQL port number to use
 * @return object Returns raw query result object
 */
function dbQuery(
    $query,
    $debug = "FALSE",
    $dbHost = DB_HOST,
    $dbName = DB_NAME,
    $dbUsername = DB_USERNAME,
    $dbPassword = DB_PASSWORD,
    $dbPort = DB_PORT
) {
    $db = mysqli_init(); // instantiate new mysqli database connection

    if (!$db) { // if initialising mysqli fails
        echo "<p>- Cannot connect to database.</p>"; // output error message
    } else {
        // UNCOMMENT WHEN CONNECTING TO REAL SERVER
        // COMMENT WHEN CONNECTING TO LOCAL SERVER
        mysqli_ssl_set($db, NULL, NULL, NULL, "/public_html", NULL); // establish ssl connection
        if ($debug == 1) { // if debugging is activated
            echo "<p>- SSL connection established.</p>"; // output success message
        }

        mysqli_real_connect($db, $dbHost, $dbUsername, $dbPassword, $dbName, $dbPort, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT); // connect to real mysql server

        mysqli_set_charset($db, "utf8");

        if (mysqli_connect_errno()) { // if an error occurs whilst connecting
            echo "<p>- Cannot connect to database: " // better than using die()
                . $db->connect_error . "\n" // output error message
                . $db->connect_errno . "</p>"; // output error number
        } else {
            if ($debug == 1) { // if debugging is activated
                echo "<p>- Connected to server " // output success message
                    . mysqli_get_host_info($db)
                    . " as user " . DB_USERNAME . ".</p>";
            }
        }

        # Run query on MySQL database
        $result = mysqli_query($db, $query); // get raw data from sql server with query

        if ($result == NULL) { // if an error occurs whilst querying
            echo "<p>- Query failed: " // output error message
                . $query . "</p>"; // output query
        } else {
            return $result;
        }
    }

    # Disconnect from the MySQL database with MySQLi
    mysqli_close($db);
    if ($debug == 1) {
        echo "<p>- Disconnected from server " . DB_HOST . ".</p>";
    }
}

/**
 * Print credentials used by default MySQL connection
 * @param bool $print Flag to enable activation of function
 * @param bool $pwd Flag to enable printing of sensitive server password
 * @return void This function doesn't return anything
 */
function printCredentials(bool $print = TRUE, bool $pwd = FALSE)
{
    if ($print == 1) {
        echo "<hr>" // insert seperator

            . "<h3>SERVER CREDENTIALS USED:</h3>"
            . "<p>Host: " . DB_HOST . "</p>" // print host
            . "<p>Username: " . DB_USERNAME . "</p>"; // print username

        if ($pwd == 1) {
            echo "<p>Password: " . DB_PASSWORD . "</p>"; // print password if enabled
        }

        echo "<p>DB Name: " . DB_NAME . "</p>" // print database name
            . "<p>DB Port: " . DB_PORT . "</p>" // print database port

            . "<hr>"; // insert seperator
    }
}

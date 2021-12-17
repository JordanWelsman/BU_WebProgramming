<?php
# Include database server credentials and connection function
// require_once 'db/config_local.php';
require_once 'db/config_uni.php';
require_once 'db/db.php';

printCredentials(FALSE);

// START SESSION IF NONE IS STARTED
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTS | Properly Organised Shipment Tracking System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="ico/favicon.ico" type="image/x-icon" />
</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="left-header">
                <p class="logo">POSTS</p>
                <a href="../index.php">Dashboard</a>
                <a href="queries.php">Queries</a>
                <a href="statuses.php">Statuses</a>
                <?php
                if (isset($_SESSION["userid"])) {
                    if ($_SESSION["useradmin"] == true) {
                        echo "<a href='admin.php' class='admin-nav'>Admin Area</a>";
                    }
                }
                ?>
            </div>

            <div class="right-header">
                <?php
                if (basename($_SERVER['PHP_SELF']) !== "index.php") {
                    echo "<form class='search-form' action='inc/search.inc.php' method='post'>
                    <input type='text' name='trackingnumber' placeholder='AB123456789CD' minlength='13' maxlength='13'>
                    <button type='submit' name='search'><i class='fa fa-search'></i>🔍</button>
                </form>";
                }
                ?>

                <?php
                if (isset($_SESSION["userid"])) {
                    echo "<a href='newpackage.php'>Track New Package</a>";
                    echo "<a href='mypackages.php'>My Packages</a>";
                    echo "<a href='account.php'>My Account</a>";
                    echo "<a href='inc/logout.inc.php'>Log Out</a>";
                } else {
                    echo "<a href='signup.php'>Sign Up</a>";
                    echo "<a href='login.php'>Log In</a>";
                }
                ?>
            </div>
        </nav>

        <hr>
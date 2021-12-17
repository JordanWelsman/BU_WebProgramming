<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Search Results' </script>";
?>

<?php
require_once 'db/config_uni.php';
require_once 'db/db.php';
require_once 'inc/functions.inc.php';

if (!isset($_GET["tracking"])) {
    header("location: index.php?error=emptysearch");
}
?>

<h1>Search results are shown here.</h1>
<h2>Using the tracking number you provided, this is what we found in our database.</h2>

<?php
$searchQuery;
if (isset($_GET["tracking"])) {
    $searchQuery = $_GET["tracking"];
} else {
    header("location: index.php");
}

// Add to account:
// YU053795835PU

$query =
    "SELECT 
        p.id as 'Package ID',
        p.trackingnumber as 'Tracking No.',
        p.orderdate as 'Order Date',
        s.description as 'Status',
        p.city as 'City',
        p.country as 'Country'
    FROM packages p
        INNER JOIN statuses s on p.status = s.id
    WHERE trackingnumber = '$searchQuery' ORDER BY p.orderdate, p.trackingnumber";
$result = dbQuery($query);

if (mysqli_num_rows($result) == 0) {
    header("location: index.php?error=packagenotfound");
}
?>

<table class="results">
    <caption>Packages in our database matching your tracking number</caption>
    <tr id="header">
        <th id="trackingnumber">Tracking No.</th>
        <th id="orderdate">Order Date</th>
        <th id="destination">Destination</th>
        <th id="city">City</th>
        <th id="country">Country</th>
    </tr>
    <?php

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<tr>";
        echo "<td>" . $row[1] . "</td>"
            . "<td>" . $row[2] . "</td>"
            . "<td>" . $row[3] . "</td>"
            . "<td>" . $row[4] . "</td>"
            . "<td>" . $row[5] . "</td>";
        echo "</tr>";
        $_SESSION["packageid"] = $row[0];
    }
    ?>
</table>

<?php
// QUERY LINK EXISTS AND DISPLAY BUTTON BELOW IF DOES NOT EXIST
$userid = $_SESSION["userid"];
$packageid = $_SESSION["packageid"];

if (userPackageExists($userid, $packageid) !== true) { // if relationship between user and package doens't exist
    echo "<form method='post'>
    <input type='submit' name='addpackage' value='Add Package to Account'>
    </form>";
} else {
    echo "<p class='alert alert-info'>You are tracking this package.</p>";
    echo "<p class='alert alert-info'>See all your tracked packages<a href='mypackages.php'>here</a>.</p>";
}

if (isset($_GET["error"])) {
    if ($_GET["error"] == "alreadyaddedtouser") {
        echo "<p class='alert alert-warning'>This package has already been added to your account.</p>";
    }
} else if (isset($_GET["status"])) {
    if ($_GET["status"] == "addedtouser") {
        echo "<p class='alert alert-success'>This package was added to your account!.</p>";
    }
}
?>

<?php
if (isset($_POST["addpackage"])) {
    if (userPackageExists($userid, $packageid) !== true) {
        linkPackageToUser($userid, $packageid);
        header("location.. searchresults.php?tracking=" . $searchQuery . "&status=addedtouser");
    } else {
        header("location.. searchresults.php?tracking=" . $searchQuery . "&error=alreadyaddedtouser");
    }
}
?>

<?php
include_once 'footer.php';
?>
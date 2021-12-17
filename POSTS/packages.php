<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Admin | Packages' </script>";
?>

<?php // Require admin privileges to access
if (isset($_SESSION["userid"])) {
    if ($_SESSION["useradmin"] == false) {
        header("location: login.php?error=insufficientprivileges");
    }
} else {
    header("location: login.php?error=insufficientprivileges");
}
?>

<h1>Results from Packages table:</h1>
<h2>As an <strong>admin</strong>, you can see the packages in our database.</h2>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nosuchpackage") {
        echo "<p class='alert alert-warning'>This package does not exist!</p>";
    }
} else if (isset($_GET["status"])) {
    if ($_GET["status"] == "packagedeleted") {
        echo "<p class='alert alert-info'>Package successfully deleted.</p>";
    } else if ($_GET["status"] == "packageupdated") {
        echo "<p class='alert alert-success'>Package successfully updated.</p>";
    }
}
?>

<?php
$query =
    "SELECT 
        p.id as 'Package ID',
        p.trackingnumber as 'Tracking No.',
        p.orderdate as 'Order Date',
        s.description as 'Status',
        p.name as 'Name',
        p.destination as 'Destination',
        p.city as 'City',
        p.country as 'Country',
        p.postcode as 'Postcode'
    FROM packages p
        INNER JOIN statuses s on p.status = s.id
    ORDER BY p.orderdate DESC, p.trackingnumber";
$result = dbQuery($query);
?>

<table class="results">
    <caption>List of packages in database</caption>
    <tr id="header">
        <th id="trackingnumber">Tracking No.</th>
        <th id="orderdate">Order Date</th>
        <th id="status">Status</th>
        <th id="recipient">Recipient</th>
        <th id="destination">Destination</th>
        <th id="city">City</th>
        <th id="country">Country</th>
        <th id="postcode">Postcode</th>
        <th id="actions">Actions</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $packageid = $row[0];
        echo "<tr>";
        echo "<td>" . $row[1] . "</td>"
            . "<td>" . $row[2] . "</td>"
            . "<td>" . $row[3] . "</td>"
            . "<td>" . $row[4] . "</td>"
            . "<td>" . $row[5] . "</td>"
            . "<td>" . $row[6] . "</td>"
            . "<td>" . $row[7] . "</td>"
            . "<td>" . $row[8] . "</td>"
            . "<td class='table-buttons'>
            <form action='editpackage.php' method='post'>
            <input type='text' style='display: none;' name='packageid' value='$packageid' readonly>
            <button type='submit' name='edit'>Edit</button>
            </form>
            <form action='inc/deletepackage.inc.php' method='post'>
            <input type='text' style='display: none;' name='packageid' value='$packageid' readonly>
            <button type='submit' name='delete'>Delete</button>
            </form></td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
include_once 'footer.php';
?>
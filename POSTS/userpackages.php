<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Admin | User Packages' </script>";
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

<h1>Results from User Packages table:</h1>
<h2>As an <strong>admin</strong>, you can see the relationships between users and their packages.</h2>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nosuchuserpackage") {
        echo "<p class='alert alert-warning'>This user package does not exist!</p>";
    }
} else if (isset($_GET["status"])) {
    if ($_GET["status"] == "userpackageremoved") {
        echo "<p class='alert alert-info'>User package successfully deleted.</p>";
    }
}
?>

<?php
$query =
    "SELECT
        up.id as 'User Package ID',
        up.userid as 'User ID',
        up.packageid as 'Package ID',
        p.trackingnumber as 'Tracking No.',
        p.orderdate as 'Order Date',
        s.description as 'Status',
        u.forename as 'First Name',
        u.surname as 'Last Name',
        u.email as 'Email',
        p.destination as 'Destination',
        p.city as 'City',
        p.country as 'Country'
    FROM users u
        INNER JOIN userpackages up ON u.id = up.userid
        INNER JOIN packages p ON up.packageid = p.id
        INNER JOIN statuses s ON p.status = s.id
    ORDER BY p.trackingnumber, u.forename";
$result = dbQuery($query);
?>

<table class="results">
    <caption>List of user packages in a database</caption>
    <tr id="header">
        <th id="trackingnumber">Tracking No.</th>
        <th id="orderdate">Order Date</th>
        <th id="status">Status</th>
        <th id="recipient">Recipient</th>
        <th id="email">Email</th>
        <th id="destination">Street Address</th>
        <th id="city">City</th>
        <th id="country">Country</th>
        <th id="actions">Actions</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $relid = $row["0"];
        $userid = $row["1"];
        $packid = $row["2"];
        echo "<tr>";
        echo "<td>" . $row[3] . "</td>"
            . "<td>" . $row[4] . "</td>"
            . "<td>" . $row[5] . "</td>"
            . "<td>" . $row[6] . " " . $row[7] . "</td>"
            . "<td>" . $row[8] . "</td>"
            . "<td>" . $row[9] . "</td>"
            . "<td>" . $row[10] . "</td>"
            . "<td>" . $row[11] . "</td>"
            . "<td class='table-buttons'>
            <form action='inc/deleteuserpackage.inc.php' method='post'>
            <input type='text' style='display: none;' name='relid' value='$relid' readonly>
            <input type='text' style='display: none;' name='userid' value='$userid' readonly>
            <input type='text' style='display: none;' name='packid' value='$packid' readonly>
            <button type='submit' name='delete'>Remove</button>
            </form></td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
include_once 'footer.php';
?>
<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | My Packages' </script>";
?>

<?php
if (!isset($_SESSION["userid"])) {
    header("location: login.php");
}
?>

<h1>These are your tracked packages.</h1>
<h2>Here you can see tracking information updates and full destination details for your packages.</h2>
<h3>You can remove packages from your account when no longer needed.</h3>

<?php
$query =
    "SELECT
        up.id as 'Relationship ID',
        up.userid as 'User ID',
        up.packageid as 'Package ID',
        p.trackingnumber as 'Tracking No.',
        p.orderdate as 'Order Date',
        s.description as 'Status',
        s.comment as 'Comments',
        u.forename as 'First Name',
        u.surname as 'Last Name',
        p.destination as 'Destination',
        p.city as 'City',
        p.country as 'Country'
    FROM users u
        INNER JOIN userpackages up ON u.id = up.userid
        INNER JOIN packages p ON up.packageid = p.id
        INNER JOIN statuses s ON p.status = s.id
    WHERE u.id = " . $_SESSION['userid'] .
    " ORDER BY p.orderdate DESC, p.trackingnumber ASC";
$result = dbQuery($query);
?>

<table class="results">
    <caption>These are your tracked packages</caption>
    <tr id="header">
        <th id="trackingnumber">Tracking Number</th>
        <th id="orderdate">Order Date</th>
        <th id="status">Status</th>
        <th id="comment">Comments</th>
        <th id="name">Name</th>
        <th id="destination">Street Address</th>
        <th id="city">City</th>
        <th id="country">Country</th>
        <th id="delete">Remove</th>
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
            . "<td>" . $row[6] . "</td>"
            . "<td>" . $row[7] . " " . $row[8] . "</td>"
            . "<td>" . $row[9] . "</td>"
            . "<td>" . $row[10] . "</td>"
            . "<td>" . $row[11] . "</td>"
            . "<td><form action='inc/deletemypackage.inc.php' method='post'>
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
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nosuchuserpackage") {
        echo "<p class='alert alert-warning'>This package is not tied to your account!</p>";
    }
} else if (isset($_GET["status"])) {
    if (($_GET["status"]) == "packageremoved") {
        echo "<p class='alert alert-success'>Package removed from your account.</p>";
    }
}
?>

<?php
include_once 'footer.php';
?>
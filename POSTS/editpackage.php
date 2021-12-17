<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Admin | Edit Package' </script>";
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

<h1>Edit package tracking information.</h1>
<h2>As an <strong>admin</strong>, you can edit package tracking information.</h2>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p class='alert alert-warning'>Please populate all fields.</p>";
    }
}
?>

<?php
$packageid = $_POST["packageid"];
$query = "SELECT * FROM packages WHERE id = $packageid";
$result = dbQuery($query);

while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $trackingnumber = $row[1];
    $status = $row[2];
    $name = $row[3];
    $country = $row[4];
    $city = $row[5];
    $destination = $row[6];
    $postcode = $row[7];
    $orderdate = $row[8];
}
?>

<section class="update-form">
    <h2>Update Package Information</h2>
    <form class="user-form package-form" action="inc/updatepackage.inc.php" method="post">
        <?php
        $today = date("Y-m-d");
        echo "<label for='packageid'>Package ID:</label>";
        echo "<input type='text' name='packageid' value='$packageid' readonly>";
        echo "<label for='trackingnumber'>Tracking Number:</label>";
        echo "<input type='text' name='trackingnumber' placeholder='AB123456789CD' minlength='13' maxlength='13' value=" . $trackingnumber . ">";
        echo "<label for='status'>Status:</label>";
        echo "<select name='status' id='status'>
            <option value='P1'>Postage paid</option>
            <option value='P2'>Dispatched</option>
            <option value='P3'>In transit</option>
            <option value='P4'>Out for delivery</option>
            <option value='D1'>Delivered</option>
            <option value='D2'>With neighbour</option>
            <option value='D3'>Ready for pickup</option>
            <option value='R1'>Returned to sender</option>
            <option value='R2'>Returned to depot</option>
            <option value='C1'>Withheld</option>
            <option value='C2'>Seized</option>
            <option value='U1'>Undelivered</option>
            <option value='U2'>Lost in transit</option>
            <option value='X1'>Expired</option>
        </select>";
        echo "<script>
            let select = document.getElementById('status');
            select.value = '" . $status . "';
        </script>";
        echo "<label for='name'>Recipient:</label>";
        echo "<input type='text' name='name' placeholder='Full name...' maxlength='50' value='$name'>";
        echo "<label for='orderdate'>Order Date:</label>";
        echo "<input type='date' name='orderdate' min='2018-01-01' max=" . $today . " value=" . $orderdate . ">";
        echo "<label for='address'>Street Address:</label>";
        echo "<input type='text' name='address' placeholder='Street address...' maxlength='50' value='$destination'>";
        echo "<label for='city'>City:</label>";
        echo "<input type='text' name='city' placeholder='City name...' maxlength='50' value='$city'>";
        echo "<label for='country'>Country Code:</label>";
        echo "<input type='text' name='country' placeholder='Two-letter country code...' maxlength='2' pattern='[A-Za-z]{2}' value='$country'>";
        echo "<label for='postcode'>Postcode:</label>";
        echo "<input type='text' name='postcode' placeholder='Postcode...' maxlength='50' value='$postcode'>";
        ?>
        <button type='submit' name='editpackage'>Update Package</button>
    </form>
</section>

<?php
include_once 'footer.php';
?>
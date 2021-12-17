<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | New Package' </script>";
?>

<?php
if (!isset($_SESSION["userid"])) {
    header("location: login.php");
}
?>

<h1>Add a new package to our tracking system here.</h1>
<h2>Please provide all information where required to add complete tracking information to our system.</h2>
<h3>We will add the package to your account when you submit the tracking information.</h3>

<section class="new-form">
    <h2>New Package</h2>
    <form class="user-form parcel-form" action="inc/newpackage.inc.php" method="post">
        <label for="trackingnumber">Tracking Number:</label>
        <input type="text" name="trackingnumber" placeholder="AB123456789CD" minlength="13" maxlength="13">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="P1">Postage paid</option>
            <option value="P2">Dispatched</option>
            <option value="P3">In transit</option>
            <option value="P4">Out for delivery</option>
            <option value="D1">Delivered</option>
            <option value="D2">With neighbour</option>
            <option value="D3">Ready for pickup</option>
            <option value="R1">Returned to sender</option>
            <option value="R2">Returned to depot</option>
            <option value="C1">Withheld</option>
            <option value="C2">Seized</option>
            <option value="U1">Undelivered</option>
            <option value="U2">Lost in transit</option>
            <option value="X1">Expired</option>
        </select>
        <?php
        $fullname = $_SESSION["userfname"] . ' ' . $_SESSION["userlname"];
        $today = date("Y-m-d");
        echo "<label for='name'>Recipient:</label>";
        echo "<input type='text' name='name' placeholder='Full name...' maxlength='50' value='$fullname'>";
        echo "<label for='orderdate'>Order Date:</label>";
        echo "<input type='date' name='orderdate' min='2018-01-01' max=" . $today . " value=" . $today . ">";
        ?>
        <label for="address">Street Address:</label>
        <input type="text" name="address" placeholder="Street address..." maxlength="50">
        <label for="city">City:</label>
        <input type="text" name="city" placeholder="City name..." maxlength="50">
        <label for="country">Country Code:</label>
        <input type="text" name="country" placeholder="Two-letter country code..." maxlength="2" pattern="[A-Za-z]{2}">
        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" placeholder="Postcode..." maxlength="50">
        <button type="submit" name="addpackage">Add Package</button>
    </form>
    <?php
    if (isset($_SESSION["lastpackageadded"])) {
        $atrackingnumber = $_SESSION["lastpackageadded"];
    }
    if (isset($_SESSION["lastpackagesearched"])) {
        $strackingnumber = $_SESSION["lastpackagesearched"];
    }
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class='alert alert-warning'>Please populate all fields.</p>";
        } else if ($_GET["error"] == "packagealreadyexists") {
            echo "<p class='alert alert-info'>This tracking number already exists in our database.</p>";
            echo "<p class='alert alert-info'>Click <a href='searchresults.php?tracking=$strackingnumber'>here</a> to track this package.</p>";
        } else if ($_GET["error"] == "packageadded") {
            echo "<p class='alert alert-success'>Package successfully added!</p>";
            echo "<p class='alert alert-info'>Click <a href='searchresults.php?tracking=$atrackingnumber'>here</a> to track this package.</p>";
        }
    }
    ?>
</section>

<?php
include_once 'footer.php';
?>
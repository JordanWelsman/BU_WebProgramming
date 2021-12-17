<?php
include_once 'header.php';
?>

<div class="wrapper-page">
    <h1>Welcome to the POSTS system!</h1>
    <h2>Here you can see how many packages we are curently tracking, and for how many users.</h2>
    <h3>Enjoy your visit. Create an account or log in to start tracking!</h3>
    <?php
    $query = "SELECT id from packages";
    $presult = dbQuery($query);

    $query = "SELECT id from users";
    $uresult = dbQuery($query);

    echo "<h2>Tracking "
        . mysqli_num_rows($presult) . " packages for "
        . mysqli_num_rows($uresult) . " users as of "
        . date("Y.m.d") . " at "
        . date("h:i:sa") . ".</h2>";

    if (isset($_SESSION["userid"])) {
        echo "<h3>Hello, " . $_SESSION["userfname"] . "!</h3>";
    } else {
        echo "<h3>Hello!</h3>";
    }
    ?>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "none") {
            echo "<p class='alert alert-info'>We've gone ahead and logged you in!</p>";
        }
    }
    ?>

    <form class='search-form' action='inc/search.inc.php' method='post'>
        <input type='text' name='trackingnumber' placeholder='AB123456789CD' minlength='13' maxlength='13'>
        <button type='submit' name='search'><i class='fa fa-search'></i>🔍</button>
    </form>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptysearch") {
            echo "<p class='alert alert-warning'>Please enter a tracking number.</p>";
        } else if ($_GET["error"] == "packagenotfound") {
            echo "<p class='alert alert-info'>Package not found in database.</p>";
        } else if ($_GET["error"] == "insufficientprivileges") {
            echo "<p class='alert alert-danger'>You do not have sufficient privileges to access this area.</p>";
        }
    } else if (isset($_GET["status"])) {
        if ($_GET["status"] == "userdeleted") {
            echo "<p class='alert alert-info'>User account successfully deleted.</p>";
        }
    }
    ?>
</div>

<?php
include_once 'footer.php';
?>

<!-- WiFi Username: jordan.welsman@hotmail.co.uk -->
<!-- WiFi Password: WQUkrdKD -->
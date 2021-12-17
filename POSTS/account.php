<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | My Account' </script>";
?>

<?php
if (!isset($_SESSION["userid"])) {
    header("location: login.php");
}
?>

<h1>Here are your account details.</h1>
<h2>You can edit your account information, login credentials, and also delete your account.</h2>

<?php
if ($_SESSION["useradmin"] == true) {
    echo "<p class='alert alert-info'>You are a POSTS administrator.</p>";
}
?>

<section class="update-form">
    <h2>Update Account Details</h2>
    <form class="user-form account-form" action="inc/update.inc.php" method="post">
        <?php
        echo "<label for='forename'>First Name:</label>";
        echo "<input type='text' name='forename' placeholder='First name...' maxlength='50' value=" . $_SESSION["userfname"] . ">";
        echo "<label for='surname'>Last Name:</label>";
        echo "<input type='text' name='surname' placeholder='Last name...' maxlength='50' value=" . $_SESSION["userlname"] . ">";
        echo "<label for='email'>Email:</label>";
        echo "<input type='text' name='email' placeholder='Email...' maxlength='50' value=" . $_SESSION["useremail"] . ">";
        ?>
        <button type="submit" name="updateaccount">Update</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptydetails") {
            echo "<p class='alert alert-warning'>Please populate all fields.</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p class='alert alert-warning'>Please enter a valid email.</p>";
        } else if ($_GET["error"] == "emailalreadyused") {
            echo "<p class='alert alert-info'>This email is already in use.</p>";
        } else if ($_GET["error"] == "detailsupdated") {
            echo "<p class='alert alert-success'>Successfully updated details!</p>";
            echo "<a href='logout.php'>Log Out</a>";
        }
    }
    ?>

    <h2>Change Password</h2>
    <form class="user-form password-form" action="inc/update.inc.php" method="post">
        <label for="oldpwd">Old Password:</label>
        <input type="password" name='oldpwd' placeholder='Old password...' maxlength='32'>
        <label for="pwd">New Password:</label>
        <input type="password" name='pwd' placeholder='New password...' maxlength='32'>
        <label for="pwdrepeat">Confirm Password:</label>
        <input type="password" name='pwdrepeat' placeholder='Confirm password...' maxlength='32'>
        <button type="submit" name="updatepassword">Change</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptypassword") {
            echo "<p class='alert alert-warning'>Please populate all fields.</p>";
        } else if ($_GET["error"] == "reusedpassword") {
            echo "<p class='alert alert-warning'>Please use a different password for your new password .</p>";
        } else if ($_GET["error"] == "mismatchedpasswords") {
            echo "<p class='alert alert-warning'>Please ensure passwords match.</p>";
        } else if ($_GET["error"] == "incorrectpassword") {
            echo "<p class='alert alert-danger'>Old password not recognised.</p>";
        } else if ($_GET["error"] == "passwordupdated") {
            echo "<p class='alert alert-success'>Successfully changed password!</p>";
            echo "<a href='logout.php'>Log Out</a>";
        }
    }
    ?>
</section>

<section class="delete-form">
    <h2>Delete Account</h2>
    <form class="user-form delete-form" action="inc/delete.inc.php" method="post">
        <label for="backpwd">Write your password backwards:</label>
        <input type="password" name="backpwd" placeholder="Your password backwards..." maxlength='32'>
        <button type="submit" name="deleteaccount" style="background-color: pink;">Delete Acccount</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptybackwardspassword") {
            echo "<p class='alert alert-danger'>Please enter your password backwards.</p>";
        } else if ($_GET["error"] == "incorrectbackwardspassword") {
            echo "<p class='alert alert-danger'>Please correctly enter your password backwards.</p>";
        }
    }
    ?>
</section>

<?php
include_once 'footer.php';
?>
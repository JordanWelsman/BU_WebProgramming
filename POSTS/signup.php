<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Sign Up' </script>";
?>

<?php // Redirect if user is signed in
if (isset($_SESSION["userid"])) {
    header("location: index.php?error=insufficientprivileges");
}
?>

<h1>This is where you can sign up!.</h1>
<h2>Provide account details and we'll do our best to create an account for you.</h2>
<h3>We'll send you an email and automatically log you in when you submit your account credentials.</h3>

<section class="signup-form">
    <h2>Sign Up</h2>
    <form class="user-form" action="inc/signup.inc.php" method="post">
        <input type="text" name="forename" placeholder="First name...">
        <input type="text" name="surname" placeholder="Last name...">
        <input type="text" name="email" placeholder="Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <input type="password" name="pwdrepeat" placeholder="Confirm password...">
        <button type="submit" name="submit">Sign Up</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class='alert alert-warning'>Please populate all fields.</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p class='alert alert-warning'>Please enter a valid email.</p>";
        } else if ($_GET["error"] == "mismatchedpasswords") {
            echo "<p class='alert alert-warning'>Please ensure passwords match.</p>";
        } else if ($_GET["error"] == "emailtaken") {
            echo "<p class='alert alert-danger'>Email already exists. Please use a different email.</p>";
        } else if ($_GET["error"] == "none") {
            echo "<p class='alert alert-success'>Successfully signed up!</p>";
            echo "<a href='login.php'>Log In</a>";
        }
    }
    ?>
</section>

<?php
include_once 'footer.php';
?>
<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Log In' </script>";
?>

<?php // Redirect if user is signed in
if (isset($_SESSION["userid"])) {
    header("location: index.php?error=insufficientprivileges");
}
?>

<h1>This is where you can log in.</h1>
<h2>Enter your account credentials.</h2>
<h3>We sent you an email when you signed up!</h3>

<section class="login-form">
    <h2>Log In</h2>
    <form class="user-form" action="inc/login.inc.php" method="post">
        <input type="text" name="email" placeholder="Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit">Log In</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class='alert alert-warning'>Please populate all fields.</p>";
        } else if ($_GET["error"] == "badlogin") {
            echo "<p class='alert alert-danger'>Email or password not recognised.</p>";
        } else if ($_GET["error"] == "insufficientprivileges") {
            echo "<p class='alert alert-danger'>You do not have sufficient privileges to access this area.</p>";
        }
    }
    ?>
</section>

<?php
include_once 'footer.php';
?>
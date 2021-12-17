<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Admin Dashboard' </script>";
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

<h1>Welcome to the <strong>administration</strong> dashboard!</h1>
<h2>As an <strong>admin</strong>, you have access to a range of powerful administration pages.</h2>

<section class="users">
    <h2>User List</h2>
    <a href="users.php" class='admin-nav'>Users</a>
</section>

<section class="packages">
    <h2>Package List</h2>
    <a href="packages.php" class='admin-nav'>Packages</a>
</section>

<section class="userpackages">
    <h2>User Packages List</h2>
    <a href="userpackages.php" class='admin-nav'>User Packages</a>
</section>

<?php
include_once 'footer.php';
?>
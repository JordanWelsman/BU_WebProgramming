<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Admin | Users' </script>";
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

<h1>Results from Users table:</h1>
<h2>As an <strong>admin</strong>, you can see the users in our database.</h2>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nosuchuser") {
        echo "<p class='alert alert-warning'>This user does not exist!</p>";
    }
} else if (isset($_GET["status"])) {
    if ($_GET["status"] == "userdeleted") {
        echo "<p class='alert alert-info'>User successfully deleted.</p>";
    } else if ($_GET["status"] == "adminupdated") {
        echo "<p class='alert alert-info'>Administrator status updated.</p>";
    }
}
?>

<?php
$query = "SELECT * FROM users ORDER BY id ASC";
$result = dbQuery($query);
?>

<table class="results">
    <caption>List of users in database</caption>
    <tr id="header">
        <th id="id">User ID</th>
        <th id="name">Name</th>
        <th id="email">Email</th>
        <th id="admin">Admin</th>
        <th id="actions">Actions</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $userid = $row["0"];
        $admin = $row["5"];
        echo "<tr>";
        echo "<td>" . $row[0] . "</td>"
            . "<td>" . $row[1] . " " . $row[2] . "</td>"
            . "<td>" . $row[3] . "</td>"
            . "<td>" . ($row[5] ? "Yes" : "No") . "</td>"
            . "<td class='table-buttons'>
            <form action='inc/toggleadmin.inc.php' method='post'>
            <input type='text' style='display: none;' name='userid' value='$userid' readonly>
            <input type='text' style='display: none;' name='admin' value='$admin' readonly>";
        if ($admin == false) {
            echo "<button type='submit' name='setadmin'>Grant Admin</button>";
        } else if ($admin == true) {
            if ($userid == $_SESSION["userid"]) {
                echo "<button type='submit' name='unsetadmin' disabled='disabled'>Revoke Admin</button>";
            } else {
                echo "<button type='submit' name='unsetadmin'>Revoke Admin</button>";
            }
        }
        echo "</form>
            <form action='inc/deleteuser.inc.php' method='post'>
            <input type='text' style='display: none;' name='userid' value='$userid' readonly>";
        if ($userid == $_SESSION["userid"]) {
            echo "<button type='submit' name='delete' disabled='disabled'>Delete</button>";
        } else {
            echo "<button type='submit' name='delete'>Delete</button>";
        }
        echo "</form></td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
include_once 'footer.php';
?>
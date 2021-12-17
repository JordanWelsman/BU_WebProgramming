<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Queries' </script>";
?>

<h1>Database Statistics</h1>
<h2>Frequency of each package status:</h2>

<?php
$query =
    "SELECT
            s.description as 'Status',
            COUNT(status) as 'Frequency'
            FROM packages p
                INNER JOIN statuses s ON p.status = s.id
            GROUP BY s.description ORDER BY Frequency DESC";
$result = dbQuery($query);

echo "<ul>";
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    echo "<li>" . $row[0] . ": <strong>"
        . $row[1] . "</strong></li>";
}
echo "</ul>";
?>

<?php
include_once 'footer.php';
?>
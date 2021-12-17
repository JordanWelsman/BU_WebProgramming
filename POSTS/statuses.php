<?php
include_once 'header.php';
echo "<script>document.title = 'POSTS | Statuses' </script>";
?>

<h1>Status codes and descriptions:</h1>
<h2>For reference, this is what all of our status codes mean.</h2>
<h3>See further instructions when they are needed to advance your package shipping.</h3>

<?php
$query = "SELECT * FROM statuses";
$result = dbQuery($query);
?>

<table class="results">
    <caption>Descriptions of package statuses</caption>
    <tr id="header">
        <th id="id">Status Code</th>
        <th id="description">Status Description</th>
        <th id="comment">Comment/Further Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<tr>";
        echo "<td>" . $row[0] . "</td>"
            . "<td>" . $row[1] . "</td>"
            . "<td>" . $row[2] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
include_once 'footer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Programming Lab 1</title>
    <style>
        body {
            font-family: Arial;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h2>Task 1: Variables</h2>

    <h3>1.</h3>
    <p>
        <?php
            $miles = 70;
            $kilometres = $miles * 1.60934;
            echo "$miles mi in km is $kilometres km";
        ?>
    </p>

    <h3>2.</h3>
    <p>
        <?php
            $celsius = 25;
            $farenheit = ($celsius * (9/5)) + 32;
            echo $celsius, "ºC is ", $farenheit, "ºF";
        ?>
    </p>

    <h3>3.</h3>
    <?php
        $name1 = "Jordan";
        $name2 = "Jacob";
        $name3 = "Bailey";
        $name4 = "William";
        $name5 = "Sonya";

        echo "
            <ol>
                <li>$name1</li>
                <li>$name2</li>
                <li>$name3</li>
                <li>$name4</li>
                <li>$name5</li>
            </ol>
            ";

    ?>

    <hr>

    <h2>Task 2: Control Sctuctures</h2>

    <h3>1.</h3>
    <?php
        $integer = 1;
        $boolean = true;
        if ($integer == $boolean) {
            echo "<p>$integer and $boolean are equal.</p>";
        }
        else {
            echo "<p>$integer and $boolean are not equal.</p>";
        }

        if ($integer === $boolean) {
            echo "<p>$integer and $boolean are of equal datatypes.</p>";
        }
        else {
            echo "<p>$integer and $boolean are not of equal datatypes.</p>";
        }
    ?>

    <h3>2.</h3>
    <?php
        $integer = 1;
        $boolean = true;
        if ($integer OR $boolean) {
            echo "<p>$integer and $boolean are OR True.</p>";
        }
        else {
            echo "<p>$integer and $boolean are OR False.</p>";
        }

        if ($integer XOR $boolean) {
            echo "<p>$integer and $boolean are XOR True.</p>";
        }
        else {
            echo "<p>$integer and $boolean are XOR False.</p>";
        }
    ?>

    <h3>3.</h3>
    <?php
        $loop1 = 1;
        echo "<p>";
        while ($loop1 <= 10) {
            echo $loop1, " ";
            $loop1++;
        }
        echo "</p>";

        echo "<p>";
        for ($loop2 = 1; $loop2 <= 10; $loop2++) {
            echo $loop2, " ";
        }
        echo "</p>";
    ?>

    <hr>

    <h2>Self Study Tasks</h2>

    <h3>Arithmetic-Assignment Operators and Variables</h3>
    <?php
        echo "<ul>";
        $number = 5;
        echo "<li>Value is now $number.</li>";
        $number = $number * 6;
        echo "<li>Multiply by 6. Value is now $number.</li>";
        $number = $number + 2;
        echo "<li>Add 2. Value is now $number.</li>";
        $number = $number / 8;
        echo "<li>Divide by 8. Value is now $number.</li>";
        $number = $number % 2;
        echo "<li>Modulo by 2. Value is now $number.</li>";
        $number++;
        echo "<li>Incerment value by one. Value is now $number.</li>";
        echo "</ul>";
    ?>

    <h3>HTML Tables and PHP</h3>
    <?php
        // salary variables
        $pgmr = "£35,000";
        $seng = "£50,000";
        $grld = "£55,000";

        echo "<table>
        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Salary</th>
        </tr>
        <tr>
            <td>Aaaa Bbbbb</td>
            <td>Programmer</td>
            <td>
                    $pgmr
            </td>
        </tr>
        <tr>
            <td>Ccc Dddddd</td>
            <td>Software Engineer</td>
            <td>
                    $seng
            </td>
        </tr>
        <tr>
            <td>Eeee Fffff</td>
            <td>Group Lead</td>
            <td>
                    $grld
            </td>
        </tr>
    </table>";
    ?>

</body>
</html>
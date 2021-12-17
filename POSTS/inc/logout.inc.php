<?php

session_start();
session_unset();
session_destroy();

if ($_GET["status"] == "userdeleted") {
    header("location: ../index.php?status=userdeleted");
    exit();
}
header("location: ../index.php");

<?php

if (isset($_POST["delete"])) {

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (isset($_POST["packageid"])) {
        $table = "packages";

        $packageid = $_POST["packageid"];

        if (packageExists($packageid)) {
            echo "" . $packageid;
            deleteFromTable($table, $packageid);
            header("location: ../packages.php?status=packagedeleted");
            exit();
        } else {
            header("location: ../packages.php?error=nosuchpackage");
        }
    }
} else {
    header("location: ../packages.php");
}

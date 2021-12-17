<?php

if (isset($_POST["delete"])) {

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (isset($_POST["relid"])) {
        $table = "userpackages";

        $relid = $_POST["relid"];
        $userid = $_POST["userid"];
        $packid = $_POST["packid"];

        if (userPackageExists($userid, $packid)) {
            echo "" . $userid . " " . $packid;
            deleteFromTable($table, $relid);
            header("location: ../mail/packageremoved.php");
            exit();
        } else {
            header("location: ../mypackages.php?error=nosuchuserpackage");
        }
    }
} else {
    header("location: ../mypackages.php");
}

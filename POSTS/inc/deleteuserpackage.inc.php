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
            echo "" . $relid . " " . $userid . " " . $packid;
            deleteFromTable($table, $relid);
            header("location: ../userpackages.php?status=userpackageremoved");
            exit();
        } else {
            header("location: ../userpackages.php?error=nosuchuserpackage");
        }
    }
} else {
    header("location: ../userpackages.php");
}

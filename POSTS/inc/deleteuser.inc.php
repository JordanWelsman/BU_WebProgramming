<?php

if (isset($_POST["delete"])) {

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (isset($_POST["userid"])) {
        $table = "users";

        $userid = $_POST["userid"];

        if (userExists($userid)) {
            //echo "" . $userid;
            deleteFromTable($table, $userid);
            header("location: ../users.php?status=userdeleted");
            exit();
        } else {
            header("location: ../users.php?error=nosuchuser");
        }
    }
} else {
    header("location: ../users.php");
}

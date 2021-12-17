<?php

if (isset($_POST["setadmin"])) {

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (isset($_POST["userid"])) {
        $userid = $_POST["userid"];
        $adminstate = 1;

        if (userExists($userid)) {
            //echo "SETADMIN - USER ID: " . $userid . " ADMINSTATE: " . $adminstate;
            setAdmin($userid, $adminstate);
            header("location: ../users.php?status=adminupdated");
            exit();
        } else {
            header("location: ../users.php?error=nosuchuser");
        }
    }
} else if (isset($_POST["unsetadmin"])) {

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (isset($_POST["userid"])) {
        $userid = $_POST["userid"];
        $adminstate = 0;

        if (userExists($userid)) {
            //echo "UNSETADMIN - USER ID: " . $userid . " ADMINSTATE: " . $adminstate;
            setAdmin($userid, $adminstate);
            header("location: ../users.php?status=adminupdated");
            exit();
        } else {
            header("location: ../users.php?error=nosuchuser");
        }
    }
} else {
    header("location: ../users.php");
}

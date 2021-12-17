<?php

if (isset($_POST["deleteaccount"])) {

    $backpwd = $_POST["backpwd"];

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (emptyInputDeleteUser($backpwd) !== false) {
        header("location: ../account.php?error=emptybackwardspassword");
        exit;
    }

    if (verifyBackwardsPassword($backpwd) !== false) {
        header("location: ../account.php?error=incorrectbackwardspassword");
        exit();
    }

    deleteUser();
    exit();
} else {
    header("location: ../index.php?error=insufficientprivileges");
}

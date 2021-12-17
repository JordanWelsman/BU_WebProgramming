<?php

if (isset($_POST["updateaccount"])) {
    $forename = $_POST["forename"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (emptyInputUpdateDetails($forename, $surname, $email) !== false) {
        header("location: ../account.php?error=emptydetails");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../account.php?error=invalidemail");
        exit();
    }

    // if (emailExists($email) !== false) {
    //     header("location: ../account.php?error=emailalreadyused");
    //     exit();
    // }

    updateDetails($forename, $surname, $email);
} else if (isset($_POST["updatepassword"])) {
    $oldpwd = $_POST["oldpwd"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (emptyInputUpdatePassword($oldpwd, $pwd, $pwdrepeat) !== false) { // check any field is empty
        header("location: ../account.php?error=emptypassword"); // triggers
        exit();
    }

    if (reusedPassword($oldpwd, $pwd) !== false) { // check new password is identitcal to old password
        header("location: ../account.php?error=reusedpassword"); // triggers
        exit();
    }

    if (mismatchedPassword($pwd, $pwdrepeat) !== false) { // check user incorrectly repeated passwords
        header("location: ../account.php?error=mismatchedpasswords"); // triggers
        exit();
    }

    if (verifyOldPassword($oldpwd) !== false) { // check that old password doesn't match password in database
        header("location: ../account.php?error=incorrectpassword"); // triggers when necessary
        exit();
    }

    updatePassword($pwd);
} else {
    header("location: ../account.php");
}

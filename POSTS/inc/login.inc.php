<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $pwd = $_POST['pwd'];

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($email, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($email, $pwd);
} else {
    header("location: ../login.php");
}

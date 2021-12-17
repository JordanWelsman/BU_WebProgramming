<?php

if (isset($_POST["addpackage"])) {
    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    $userid = $_SESSION["userid"];

    $packageid = findNextPackageId();

    $trackingnumber = $_POST["trackingnumber"];
    $status = $_POST["status"];
    $name = $_POST["name"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $postcode = $_POST["postcode"];
    $orderdate = $_POST["orderdate"];

    echo $userid . " | "
        . $packageid . " "
        . $trackingnumber . " "
        . $status . " "
        . $name . " "
        . $country . " "
        . $city . " "
        . $address . " "
        . $postcode . " "
        . $orderdate . " ";

    if (emptyInputPackage($trackingnumber, $status, $name, $country, $city, $address, $orderdate) !== false) {
        header("location: ../newpackage.php?error=emptyinput");
        exit();
    }

    if (trackingNumberExists($trackingnumber)) {
        header("location: ../newpackage.php?error=packagealreadyexists");
        exit();
    }

    createPackage($trackingnumber, $status, $name, $country, $city, $address, $postcode, $orderdate, $userid, $packageid);
} else {
    header("location: ../index.php?error=insufficientprivileges");
}

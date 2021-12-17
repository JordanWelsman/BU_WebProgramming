<?php

if (isset($_POST["editpackage"])) {
    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    $packageid = $_POST["packageid"];
    $trackingnumber = $_POST["trackingnumber"];
    $status = $_POST["status"];
    $name = $_POST["name"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $postcode = $_POST["postcode"];
    $orderdate = $_POST["orderdate"];

    if (emptyInputPackage($trackingnumber, $status, $name, $country, $city, $address, $orderdate) !== false) {
        header("location: ../editpackage.php?error=emptyinput");
        exit();
    }

    updatePackage($packageid, $trackingnumber, $status, $name, $country, $city, $address, $postcode, $orderdate);
} else {
    header("location: ../index.php?error=insufficientprivileges");
}

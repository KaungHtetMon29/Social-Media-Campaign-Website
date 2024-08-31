<?php
include '../../../database/dbutil.php';
$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$usercredentials = $_POST;
session_start();

if ($_POST["password"] !== $_POST["repassword"]) {
    $_SESSION['error'] = "Passwords do not match";
}

echo '<script>alert($_SESSION["error"])</script>';


// header("Location: ../../../index.php");
unset($usercredentials['repassword']);
print_r($usercredentials);
print_r($dbinstance->insert("user", $usercredentials));

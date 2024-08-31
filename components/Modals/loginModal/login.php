<?php
include '../../../database/dbutil.php';
include '../../../utils/php/validation.php';
session_start();

$usercredentials = [
    "email" => $_POST["email"],
    "password" => $_POST["password"]
];
$_SESSION["tempcredentials"] = $usercredentials;
unset($_SESSION["tempcredentials"]["password"]);
function validate()
{
    global $usercredentials;
    $dbconnection = new Dbconnect();
    $connection = $dbconnection->connect();
    $userdata = $dbconnection->select_one(["email" => $usercredentials["email"]], 'user');
    print_r(count($userdata));
    if ($userdata === null) {
        $_SESSION['statusmsg'] = ["form" => "login", "msg" => "Wrong Email Address or Password"];
        header("Location: ../../../index.php");
        exit();
    }
    if (!password_verify($usercredentials["password"], $userdata["password"])) {
        $_SESSION['statusmsg'] = ["form" => "login", "msg" => "Wrong Password"];
        header("Location: ../../../index.php");
        exit();
    }
    $_SESSION["tempcredentials"]["name"] = $userdata["name"];
    $_SESSION["statusmsg"] = "Signup successful";
    header("Location: ../../../index.php");
    exit();
}

foreach (array_keys($usercredentials) as $key => $value) {
    if ($value === "email") {
        validateEmpty($usercredentials["email"], "email", "login");
        validateEmail("login");
    } else if ($value === "password") {
        validateEmpty($usercredentials["password"], "password", "login");
    }
}
validate();

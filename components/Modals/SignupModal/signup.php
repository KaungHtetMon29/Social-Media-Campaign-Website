<?php
include '../../../database/dbutil.php';
include '../../../utils/php/validation.php';
session_start();

$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$usercredentials = $_POST;
$_SESSION["tempcredentials"] = $usercredentials;
// if (strlen($_POST["name"]) === 0) {
//     $_SESSION['statusmsg'] = $error["name"]["empty"];
//     exit();
// } else if(){}else if ($_POST["password"] !== $_POST["repassword"]) {
//     $_SESSION['statusmsg'] = "Passwords do not match";
//     header("Location: ../../../index.php");
//     exit();
// }



foreach (array_keys($usercredentials) as $key => $value) {
    if ($value === "name") {
        validateEmpty($usercredentials["name"], "name", "signup");
    } else if ($value === "dob") {
        validateEmpty($usercredentials["dob"], "dob", "signup");
    } else if ($value === "email") {
        validateEmail("signup");
    } else if ($value === "password") {
        validatePassword("signup");
    }
}
;
// header("Location: ../../../index.php");
unset($usercredentials['repassword']);
$usercredentials["password"] = password_hash($usercredentials['password'], PASSWORD_DEFAULT);
print_r($usercredentials);
$status = $dbinstance->insert("user", $usercredentials, "email");
if ($status['type'] !== "success") {
    $_SESSION['statusmsg'] = ["form" => "signup", "msg" => $error[$status["type"]][$status["detail"]]];
} else {
    $_SESSION['statusmsg'] = "Signup successful";
}

header("Location: ../../../index.php");
exit();

//--------------------------------------------Functions--------------------------------------------//

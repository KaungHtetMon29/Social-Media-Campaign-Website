<?php
include '../../../database/dbutil.php';
session_start();

$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$usercredentials = $_POST;
$_SESSION["tempcredentials"] = $usercredentials;
// if (strlen($_POST["name"]) === 0) {
//     $_SESSION['signupmsg'] = $error["name"]["empty"];
//     exit();
// } else if(){}else if ($_POST["password"] !== $_POST["repassword"]) {
//     $_SESSION['signupmsg'] = "Passwords do not match";
//     header("Location: ../../../index.php");
//     exit();
// }

$error = [
    "name" => ["empty" => "Name cannot be empty"],
    "email" => [
        "empty" => "Email can't be empty",
        "exist" => "Email already exists",
        "invalid" => "Invalid Email"
    ],
    "password" => [
        "nomatch" => "Passwords do not match",
        "invalid" => "Password must be at least 8 characters long",
        "empty" => "Password cannot be empty",
        "weak" => "Password must contain at least one uppercase letter, one lowercase letter, one number and one special character"
    ],
    "dob" => ["empty" => "Date of birth cannot be empty"]
];

foreach (array_keys($usercredentials) as $key => $value) {
    if ($value === "name") {
        validateEmpty($usercredentials["name"], "name");
    } else if ($value === "dob") {
        validateEmpty($usercredentials["dob"], "dob");
    } else if ($value === "email") {
        validateEmail();
    } else if ($value === "password") {
        validatePassword();
    }
}
;
// header("Location: ../../../index.php");
unset($usercredentials['repassword']);
$usercredentials["password"] = password_hash($usercredentials['password'], PASSWORD_DEFAULT);
print_r($usercredentials);
$status = $dbinstance->insert("user", $usercredentials, "email");
if ($status['type'] !== "success") {
    $_SESSION['signupmsg'] = $error[$dbinstance->insert("user", $usercredentials, "email")["type"]][$dbinstance->insert("user", $usercredentials, "email")["detail"]];
} else {
    $_SESSION['signupmsg'] = "Signup successful";
}

header("Location: ../../../index.php");
exit();
function validateEmpty(string $input, string $key)
{
    global $error;
    if (strlen($input) === 0) {
        $_SESSION['signupmsg'] = $error[$key]["empty"];
        header("Location: ../../../index.php");
        exit();
    }

}
function validateEmail()
{
    echo "ran";
    global $error;
    if (strlen($_POST["email"]) === 0) {
        validateEmpty($_POST["email"], "email");
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['signupmsg'] = $error["email"]["invalid"];
        header("Location: ../../../index.php");
        exit();
    }
}
function validatePassword()
{
    global $error;
    if ($_POST["password"] !== $_POST["repassword"]) {
        $_SESSION['signupmsg'] = $error["password"]["nomatch"];
        header("Location: ../../../index.php");
        exit();
    } else if (strlen($_POST["password"]) === 0) {
        validateEmpty($_POST["password"], "password");
    } else if (strlen($_POST["password"]) < 8) {
        $_SESSION['signupmsg'] = $error["password"]["invalid"];
        header("Location: ../../../index.php");
        exit();
    } else if (!preg_match("/[A-Z]/", $_POST["password"]) || !preg_match("/[a-z]/", $_POST["password"]) || !preg_match("/[0-9]/", $_POST["password"]) || !preg_match("/[^A-Za-z0-9]/", $_POST["password"])) {
        $_SESSION['signupmsg'] = $error["password"]["weak"];
        header("Location: ../../../index.php");
        exit();
    }

}
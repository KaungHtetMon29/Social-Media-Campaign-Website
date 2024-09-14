<?php
include '../../../database/dbutil.php';
include '../../../utils/php/validation.php';
include '../../../utils/php/jwt.php';
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
    switch ($value) {
        case "name":
            validateEmpty($usercredentials["name"], "name", "signup");
            break;
        case "email":
            validateEmail("signup");
            break;
        case "dob":
            validateEmpty($usercredentials["dob"], "dob", "signup");
            break;
        case "password":
            validatePassword("signup");
            break;
        case 'g-recaptcha-response':
            validateCaptcha("signup");
            break;
    }

}
;
unset($usercredentials['repassword']);
unset($usercredentials["g-recaptcha-response"]);
$usercredentials["password"] = password_hash($usercredentials['password'], PASSWORD_DEFAULT);

$usercredentials["type"] = 'user';
$status = $dbinstance->insert("user", $usercredentials, "email");
if ($status['type'] !== "success") {
    $_SESSION['statusmsg'] = ["form" => "signup", "msg" => $error[$status["type"]][$status["detail"]]];
} else {
    echo ("ran");
    $_SESSION['statusmsg'] = "Signup successful";
    $jwtobj = new JWTManager();
    $payload = ["email" => $_SESSION["tempcredentials"]["email"], "name" => $_SESSION["tempcredentials"]["name"], "role" => $_SESSION["tempcredentials"]["type"]];
    setcookie("JWT", $jwtobj->createToken($payload), time() + 3600, "/", "", false, true);
    setcookie(
        "credentials",
        json_encode(
            [
                "name" => $_SESSION["tempcredentials"]["name"],
                "email" => $_SESSION["tempcredentials"]["email"],
                "role" => $_SESSION["tempcredentials"]["type"]
            ]
        ),
        time() + 3600,
        "/",
        "",
        false,
        true
    );
}
header("Location: ../../../index.php");
exit();

//--------------------------------------------Functions--------------------------------------------//

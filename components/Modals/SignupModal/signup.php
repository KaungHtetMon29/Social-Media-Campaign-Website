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
// if (isset($_POST['g-recaptcha-response'])) {

//     $captcha = $_POST['g-recaptcha-response'];

// }
// if (!$captcha) {
//     $_SESSION['statusmsg'] = ["form" => $form, "msg" => "Please check the captcha"];
//     header("Location: ../../../index.php");
//     exit;
// }
// header("Location: ../../../index.php");
unset($usercredentials['repassword']);
$usercredentials["password"] = password_hash($usercredentials['password'], PASSWORD_DEFAULT);
$usercredentials["type"] = 'user';
$status = $dbinstance->insert("user", $usercredentials, "email");
if ($status['type'] !== "success") {
    $_SESSION['statusmsg'] = ["form" => "signup", "msg" => $error[$status["type"]][$status["detail"]]];
} else {
    $_SESSION['statusmsg'] = "Signup successful";
}
header("Location: ../../../index.php");
exit();

//--------------------------------------------Functions--------------------------------------------//

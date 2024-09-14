<?php
$error = [
    "title" => ["empty" => "Title cannot be empty"],
    "content" => ["empty" => "content cannot be empty"],
    "image" => ["empty" => "image cannot be empty"],
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
function redirect($location)
{
    header("Location: $location");
    exit();
}
function validateEmpty(string $input, string $key, string $form, string $location = '../../../index.php')
{
    global $error;
    if (strlen($input) === 0) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => $error[$key]["empty"]];
        redirect($location);
    }

}
function validateEmail(string $form, string $location = '../../../index.php')
{
    global $error;
    if (strlen($_POST["email"]) === 0) {
        validateEmpty($_POST["email"], "email", $form, $location);
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => $error["email"]["invalid"]];
        redirect($location);
    }
}
function validatePassword(string $form, string $location = '../../../index.php')
{
    global $error;
    if ($_POST["password"] !== $_POST["repassword"]) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => $error["password"]["nomatch"]];
        redirect($location);
    } else if (strlen($_POST["password"]) === 0) {
        validateEmpty($_POST["password"], "password", $form, $location);
    } else if (strlen($_POST["password"]) < 8) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => $error["password"]["invalid"]];
        redirect($location);
    } else if (!preg_match("/[A-Z]/", $_POST["password"]) || !preg_match("/[a-z]/", $_POST["password"]) || !preg_match("/[0-9]/", $_POST["password"]) || !preg_match("/[^A-Za-z0-9]/", $_POST["password"])) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => $error["password"]["weak"]];
        redirect($location);
    }

}

function validateCaptcha(string $form)
{
    $secretKey = "6LfPxDUqAAAAAJAWdil0wyqn0pL96f9X107UDWkK";
    $ip = $_SERVER['REMOTE_ADDR'];
    global $error;
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => "Please check the captcha"];
        header("Location: ../../../index.php");
        exit();
    }
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);
    if (!$responseKeys["success"]) {
        $_SESSION['statusmsg'] = ["form" => $form, "msg" => "reCaptcha verification failed"];
        header("Location: ../../../index.php");
        exit();
    }
}
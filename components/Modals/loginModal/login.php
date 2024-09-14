<?php
include '../../../database/dbutil.php';
include '../../../utils/php/validation.php';
include '../../../utils/php/jwt.php';
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
    $_SESSION["tempcredentials"]["type"] = $userdata["type"];
    $_SESSION["statusmsg"] = "Signup successful";
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
    switch ($userdata["type"]) {
        case "admin":
            header("Location:../../../admin/adminpanel.php");
            break;
        case "user":
            header("Location: ../../../index.php");
            break;
    }

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

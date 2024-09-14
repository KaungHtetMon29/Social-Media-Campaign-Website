<?php
include '../../../utils/php/validation.php';
include '../../../database/dbutil.php';
session_start();
$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$usercredentials = $_POST;
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"], $params);

foreach (array_keys($usercredentials) as $key => $value) {
    switch ($value) {
        case "name":
            validateEmpty(
                $usercredentials["name"],
                "name",
                "signup",
                "../../adminpanel.php?tab=" . $params["tab"]
            );
            break;
        case "email":
            validateEmail(
                "signup",
                "../../adminpanel.php?tab=" . $params["tab"]
            );
            break;
        case "dob":
            validateEmpty(
                $usercredentials["dob"],
                "dob",
                "signup",
                "../../adminpanel.php?tab=" . $params["tab"]
            );
            break;
        case "password":
            validatePassword(
                "signup",
                "../../adminpanel.php?tab=" . $params["tab"]
            );
            break;
    }

}


unset($usercredentials['repassword']);
$usercredentials["password"] = password_hash($usercredentials['password'], PASSWORD_DEFAULT);
$usercredentials["type"] = $params["tab"];

if ($params["update"] === "true") {
    $usercredentials["identifier"] = $params["email"];
    $status = $dbinstance->update("user", $usercredentials, "email");
} else {
    $status = $dbinstance->insert("user", $usercredentials, "email");
}

if ($status['type'] !== "success") {
    $_SESSION['statusmsg'] = ["form" => "signup", "msg" => $error[$status["type"]][$status["detail"]]];
    header("Location: ../../adminpanel.php?tab=" . $params["tab"] . "&create=true");
} else {
    $_SESSION['statusmsg'] = ["msg" => "Upload Successfull"];
    header("Location: ../../adminpanel.php?tab=" . $params["tab"] . "");
}

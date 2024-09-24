<?php
require '../components/header/header.php';
require './layout/mainlayout.php';
require '../utils/php/jwt.php';
require '../database/dbutil.php';
require './components/View/view.php';
require './components/View/contentView.php';
require './components/View/popularAppView.php';
require 'components/Modal/createUserModal.php';
require 'components/Modal/createContentModal.php';
require './components/View/messageView.php';


session_start();

if (!isset($_GET["tab"])) {
    header("Location:adminpanel.php?tab=user");
}
if (isset($_POST["close"])) {
    if ($_POST["close"]) {
        header("Location:adminpanel.php?tab=" . $_POST["close"]);
    }
}

$dbconnection = new Dbconnect();
$connection = $dbconnection->connect();
$jwtmanager = new JWTManager();

if (isset($_COOKIE["JWT"])) {
    if ($jwtmanager->verifyToken($_COOKIE["JWT"])) {
        $user = $jwtmanager->decodeToken($_COOKIE["JWT"]);
        if ($user["role"] !== "admin") {
            header("Location: ../index.php");
            exit();
        }
    }
    ;
} else {
    header("Location: ../index.php");
    exit();
}
if (isset($_GET["logout"])) {
    if ($_GET["logout"]) {
        session_destroy();
        header("Location: ../index.php?logout=true");
    }
}
if (isset($_GET["email"]) && !isset($_GET["update"])) {
    if ($dbconnection->delete_one("user", ["email" => $_GET["email"]])) {
        header("Location: adminpanel.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/index.css" />
    <script defer type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script defer src="js/index.js" type="module"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="adminpanel">
    <?php
    if (isset($_GET["update"])) {
        createUserModal(true, $dbconnection);
    }
    if (isset($_GET["update_content"]) && ($_GET["tab"] === "information" || $_GET["tab"] === "popularapp")) {
        createContentModal(true, $dbconnection);
    }
    if (isset($_GET["create"])) {
        createUserModal(false, $dbconnection);
    }
    if (isset($_GET["create_content"])) {
        createContentModal(false, $dbconnection);
    }
    ?>
    <?php
    switch ($_GET["tab"]) {
        case 'user':
            Layout(View($dbconnection), $user);
            break;
        case 'admin':
            Layout(View($dbconnection, "admin"), $user);
            break;
        case 'information':
            Layout(contentView($dbconnection), $user);
            break;
        case 'popularapp':
            Layout(popularAppView($dbconnection), $user);
            break;
        case 'usermessages':
            Layout(messageView($dbconnection), $user);
            break;

    }
    ?>
</body>
<?php
if (isset($_SESSION["statusmsg"])) {
    echo '<script>
  window.onload = function () {
    alert("' . $_SESSION["statusmsg"]["msg"] . '");
  };
  </script>';
}

unset($_SESSION["statusmsg"]);
?>

</html>
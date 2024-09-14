<?php
require '../../../database/dbutil.php';

$dbconnection = new Dbconnect();
$connection = $dbconnection->connect();
if (isset($_GET["id"]) && isset($_GET["tab"])) {
    if ($dbconnection->delete_one($_GET["tab"], ["id" => $_GET["id"]])) {
        header('Location: ../../adminpanel.php?tab=' . $_GET["tab"] . '');
    }
}

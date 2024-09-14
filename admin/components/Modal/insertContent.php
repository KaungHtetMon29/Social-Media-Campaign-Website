<?php
include '../../../utils/php/validation.php';
include '../../../database/dbutil.php';
session_start();
$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$contentdata = $_POST;
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"], $params);
$prev_img = $contentdata['prev_img'];
unset($contentdata['prev_img']);
print_r($contentdata);
foreach (array_keys($contentdata) as $key => $value) {
    validateEmpty(
        $contentdata[$value],
        $value,
        "signup",
        "../../adminpanel.php?tab=" . $params["tab"] . "&create_content=true"
    );
}

$tablename = $params["tab"];
if ($_FILES['image']['size'] !== 0) {
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageContent = file_get_contents($imageTmpName);
    $imageBase64 = base64_encode($imageContent);
    $imageUrl = 'data:image/' . pathinfo($imageName, PATHINFO_EXTENSION) . ';base64,' . $imageBase64;
    $contentdata['image'] = $imageUrl;
} else {
    $contentdata['image'] = $prev_img;
}
unset($contentdata['prev_img']);

if (isset($_GET["update_content"])) {
    if ($_GET["update_content"]) {
        $contentdata["identifier"] = $params["id"];
        $status = $dbinstance->update($tablename, $contentdata, "id");
    }

} else {
    $status = $dbinstance->insert($tablename, $contentdata);
}


if ($status['type'] !== "success") {
    $_SESSION['statusmsg'] = ["msg" => "something went wrong"];
    header("Location: ../../adminpanel.php?tab=" . $params["tab"] . "&create_content=true");
} else {
    $_SESSION['statusmsg'] = ["msg" => "Upload Successfull"];
    header("Location: ../../adminpanel.php?tab=" . $params["tab"] . "");
}

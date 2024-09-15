<?php
require 'database/dbutil.php';
require 'components/header/header.php';
require 'utils/body_generator/bodyGen.php';
$popular = [
    "title" => "Popular",
    "content" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti voluptatem distinctio aperiam necessitatibus fuga
    officiis nostrum dignissimos odit, obcaecati laudantium ratione unde, quas, quasi tenetur esse. Rem voluptates amet
    omnis!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti voluptatem distinctio aperiam necessitatibus fuga
    officiis nostrum dignissimos odit, obcaecati laudantium ratione unde, quas, quasi tenetur esse. Rem voluptates amet
    omnis!",
    "img" => "https://via.placeholder.com/150"
];
// $contents = [$popular, $popular, $popular, $popular, $popular, $popular, $popular];
$dbinstance = new Dbconnect();
$dbinstance->connect();
if (isset($_GET['input'])) {
    if (strlen($_GET["input"]) > 0) {
        $contents = $dbinstance->select_all(
            "popularapp",
            ["id", "appname", "content", "image"],
            "appname='" . $_GET["input"] . "'"
        );
    } else {
        $contents = $dbinstance->select_all("popularapp", ["id", "appname", "content", "image"]);
    }

} else {
    $contents = $dbinstance->select_all("popularapp", ["id", "appname", "content", "image"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
setheader("Popular");
?>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <?php
    $bdygen = new BodyGen($contents, true, false, ['id', 'appname', 'content', 'image']);
    $bdygen->generateBody();
    ?>
    <?php include 'components/footer/footer.php'; ?>
</body>
<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>
<?php
if (isset($_SESSION["statusmsg"])) {
    echo '<script>
    window.onload = function () {
      alert("' . $_SESSION["statusmsg"]["msg"] . '");
    };
    </script>';
    unset($_SESSION["statusmsg"]);
}

?>


</html>
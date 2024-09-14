<?php
require 'database/dbutil.php';
require 'utils/php/jwt.php';
require 'components/header/header.php';
require 'utils/body_generator/bodyGen.php';
session_start();
if (isset($_SESSION["statusmsg"])) {
    if ($_SESSION["statusmsg"] === "Signup successful") {
        if (!isset($_COOKIE["JWT"])) {
            $jwtobj = new JWTManager();
            $payload = ["email" => $_SESSION["tempcredentials"]["email"], "name" => $_SESSION["tempcredentials"]["name"]];
            setcookie("JWT", $jwtobj->createToken($payload), time() + 3600);
            setcookie("credentials", json_encode(["name" => $_SESSION["tempcredentials"]["name"], "email" => $_SESSION["tempcredentials"]["email"]]), time() + 3600);
            header("Refresh:0");
        }
        unset($_SESSION["tempcredentials"]);
    }
}
$dbinstance = new Dbconnect();
$dbinstance->connect();
$contents = $dbinstance->select_all("information", ["id", "title", "content", "image"]);

?>

<!DOCTYPE html>
<html lang="en">

<?php
setheader("Information");
?>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <div>
        <?php include 'components/Info/hero/InfoHero.php' ?>
        <?php
        $bdygen = new BodyGen($contents);
        $bdygen->generateBody();
        ?>
        <div class="hr">
            <hr>
        </div>
        <?php include 'components/footer/footer.php'; ?>
    </div>
</body>

<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>
<?php
unset($_SESSION["statusmsg"]);
?>
<?php
/*
include 'components/Info/saferInternetDay/saferInternetDay.php';
include 'components/Info/IWFcampaigns/IWFcampaigns.php';
include 'components/Info/stopcyberbullying/stopcyberbullying.php';
include 'components/Info/dianaaward/dianaaward.php';
*/
?>

</html>
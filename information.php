<?php
$mysqli = require 'database/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <div>
        <?php include 'components/Info/hero/InfoHero.php' ?>
        <?php include 'components/Info/saferInternetDay/saferInternetDay.php' ?>
        <?php include 'components/Info/IWFcampaigns/IWFcampaigns.php' ?>
        <?php include 'components/Info/stopcyberbullying/stopcyberbullying.php' ?>
        <?php include 'components/Info/dianaaward/dianaaward.php' ?>
        <div class="hr">
            <hr>
        </div>
        <?php include 'components/footer/footer.php'; ?>
    </div>
</body>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/info.js" type="module"></script>

</html>
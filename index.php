<?php
require 'database/dbutil.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SMC</title>
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>

  <?php include 'components/navbar/navbar.php'; ?>
  <div>
    <div class="primary">
      <?php include 'components/Hero/hero.php'; ?>
    </div>
    <div class="observable"><?php include 'components/risk/popularapps.php'; ?></div>
    <div class="primary1"><?php include 'components/fre_risks/fre_risks.php' ?></div>
    <div class="staysafe"><?php include 'components/staysafe/staysafe.php'; ?></div>
    <div class="hr">
      <hr>
    </div>
    <?php include 'components/footer/footer.php'; ?>
  </div>
</body>
<?php
if (isset($_SESSION["error"])) {
  echo '<script>alert("' . $_SESSION["error"] . '")</script>';
  unset($_SESSION["error"]);
} ?>
<script defer src="js/index.js" type="module"></script>

</html>
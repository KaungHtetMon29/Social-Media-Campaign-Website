<?php
require 'database/dbutil.php';
require 'utils/php/jwt.php';
require 'components/header/header.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php
setheader("SMC");
?>


<body>
  <?php include 'components/navbar/navbar.php'; ?>
  <?php include 'components/overlay/overlay.php'; ?>
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
<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>
<?php
if (isset($_SESSION["attempts"]) && $_SESSION["attempts"] >= 3) {
  echo '<script>
  window.onload = function () {
    alert("You have exceeded the maximum number of attempts. Please try again later.");
  };
  </script>';

} else
  if (isset($_SESSION["statusmsg"])) {
    if ($_SESSION["statusmsg"] !== "Signup successful") {
      switch ($_SESSION["statusmsg"]["form"]) {
        case "signup":
          echo '<script type="module">
      import { addModal } from "./components/navbar/navbar.js";
      addModal("components/Modals/signupModal/signupModal.php");
      </script>';
          break;
        case "login":
          echo '<script type="module">
      import { addModal } from "./components/navbar/navbar.js";
      addModal("components/Modals/loginModal/loginModal.php");
      </script>';
          break;
      }
      echo '<script>
  window.onload = function () {
    alert("' . $_SESSION["statusmsg"]["msg"] . '");
  };
  </script>';
    }

  }
unset($_SESSION["statusmsg"]);
?>

</html>
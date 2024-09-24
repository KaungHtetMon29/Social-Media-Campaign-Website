<?php
session_start()
  ?>
<div class="modalcontainer" id="modal">
  <div class="modalcard">
    <button id="closebtn"><img src="img/cross.svg" alt="crossimg" /></button>
    <div class="modalform">
      <div class="modalheader">
        <h2>Login</h2>
        <p>Stay safe from internet !</p>
      </div>
      <form action="components/Modals/loginModal/login.php" method="POST">
        <div>
          <label>Enter Username</label>
          <input type="text" placeholder="email" name="email"
            value="<?php echo isset($_SESSION["tempcredentials"]) ? htmlentities($_SESSION["tempcredentials"]["email"]) : "" ?>" />
        </div>
        <div>
          <label>Enter Username</label>
          <input type="password" placeholder="Password" name="password" />
        </div>
        <?php
        if (isset($_SESSION["attempts"]) && $_SESSION["attempts"] >= 3) {
          if (!isset($_SESSION["lockout_time"])) {
            $_SESSION["lockout_time"] = time();
          }
          $lockout_duration = 10 * 60; // 10 minutes in seconds
          $time_since_lockout = time() - $_SESSION["lockout_time"];
          if ($time_since_lockout < $lockout_duration) {
            echo "<p>You have been locked out due to multiple failed login attempts. Please try again after 10 minutes.</p>";
          } else {
            // Reset attempts after lockout duration
            unset($_SESSION["attempts"]);
            unset($_SESSION["lockout_time"]);
            echo '<button type="submit">Login</button>';
          }
        } else {
          echo '<button type="submit">Login</button>';
        }
        ?>

      </form>
    </div>
    <!-- <hr />
    <div class="modalfooter">
      <p>Do not have account?</p>
      <button>Sign up</button>
    </div> -->
  </div>
</div>
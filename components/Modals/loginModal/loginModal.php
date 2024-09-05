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
        <button type="submit">Login</button>
      </form>
    </div>
    <!-- <hr />
    <div class="modalfooter">
      <p>Do not have account?</p>
      <button>Sign up</button>
    </div> -->
  </div>
</div>
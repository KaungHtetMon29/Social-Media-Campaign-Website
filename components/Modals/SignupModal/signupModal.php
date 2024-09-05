<?php session_start(); ?>
<div class="modalcontainer">
  <div class="modalcard signup">
    <button id="closebtn"><img src="img/cross.svg" alt="crossimg" /></button>
    <div class="modalform">
      <div class="modalheader">
        <h2>Signup</h2>
        <p>Stay safe from internet !</p>
      </div>

      <form action="components/Modals/SignupModal/signup.php" method="POST">
        <div class="modalrow">
          <div>
            <label>Enter Username</label>
            <input type="text" placeholder="Username" name="name"
              value="<?php echo isset($_SESSION["tempcredentials"]) ? htmlentities($_SESSION["tempcredentials"]["name"]) : "" ?>" />
          </div>
          <div>
            <label>Enter Date of Birth</label>
            <input type="date" name="dob" onkeypress="return false"
              value="<?php echo isset($_SESSION["tempcredentials"]) ? htmlentities($_SESSION["tempcredentials"]["dob"]) : "" ?>" />
          </div>
        </div>
        <div>
          <label>Enter Email</label>
          <input type="text" placeholder="Email" name="email"
            value="<?php echo isset($_SESSION["tempcredentials"]) ? htmlentities($_SESSION["tempcredentials"]["email"]) : "" ?>" />
        </div>
        <div class="modalrow">
          <div>
            <label>Enter Password</label>
            <input type="password" placeholder="Password" name="password" />
          </div>
          <div>
            <label>Re-enter Password</label>
            <input type="password" placeholder="Re-enter Password" name="repassword" />
          </div>
        </div>
        <div class="g-recaptcha " data-type="image" data-sitekey="6LfPxDUqAAAAANL2LhAkHcJ7OEVlxGwpRWVs0Y4w">
        </div>
        <button type="submit">Signup</button>
      </form>
    </div>
    <!-- <hr />
    <div class="modalfooter">
      <p>Already have an account?</p>
      <button>Login</button>
    </div> -->
  </div>
  <div></div>
</div>
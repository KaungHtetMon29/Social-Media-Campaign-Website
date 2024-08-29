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
            <input type="text" placeholder="Username" name="username" />
          </div>
          <div>
            <label>Enter Date of Birth</label>
            <input type="date" name="Date of Birth" />
          </div>
        </div>
        <div>
          <label>Enter Email</label>
          <input type="password" placeholder="Email" name="email" />
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
        <button type="submit">Signup</button>
      </form>
    </div>
    <hr />
    <div class="modalfooter">
      <p>Already have an account?</p>
      <button>Login</button>
    </div>
  </div>
  <div></div>
</div>
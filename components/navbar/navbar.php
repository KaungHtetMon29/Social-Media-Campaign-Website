<nav>
    <div class="main_nav">
        <div id="nav_container">
            <a href="index.php" class="nav_ani_op1">Home</a>
            <a href="information.php" class="nav_ani_op1">Information</a>
            <a href="popular.php" class="nav_ani_op1">Popoular</a>
            <a href="tips.php" class="nav_ani_op1">Tips</a>
            <a href="livestream.php" class="nav_ani_op1">Live Stream</a>
            <a href="contact.php" class="nav_ani_op1">Contact</a>
            <a href="legislation.php" class="nav_ani_op1">Legislation and Guidance</a>
            <div class="search">
                <input placeholder="search" />
                <img src="img/search_icon.png" alt="search" class="search_icon" />
            </div>
        </div>
        <?php
        if (!isset($_COOKIE["JWT"])) {
            echo
                '<div>
                    <p href="login.php" class="login" id="loginbtn">Login</p>
                    <button class="register" id="registerbtn">Register</button>
                </div>';
        }
        ?>
        <!-- <div>
            <p href="login.php" class="login" id="loginbtn">Login</p>
            <button class="register" id="registerbtn">Register</button>
        </div> -->

    </div>
</nav>
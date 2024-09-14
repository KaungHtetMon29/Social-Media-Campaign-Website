<?php
if (isset($_GET["logout"])) {
    unset($_COOKIE["JWT"]);
    unset($_COOKIE["credentials"]);
    setcookie("JWT", "", time() - 3600, "/", "", false, true);
    setcookie("credentials", "", time() - 3600, "/", "", false, true);
    header("Location: index.php");
}
?>
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
            <?php
            if (explode('.', basename($_SERVER['PHP_SELF']))[0] === "popular") {
                echo '
                <div class="search">
                    <input placeholder="search" />
                    <img src="img/search_icon.png" alt="search" class="search_icon" />
                </div>';
            }
            ?>


        </div>
        <?php
        if (!isset($_COOKIE["JWT"])) {
            echo
                '<div>
                    <div id="google_translate_element" class="google_translate"></div>
                    <p href="login.php" class="login" id="loginbtn">Login</p>
                    <button class="register" id="registerbtn">Register</button>
                </div>';
        }
        if (isset($_COOKIE["credentials"])) {
            $usercredentials = json_decode($_COOKIE["credentials"], true);
            echo
                '<div>
                    <div id="google_translate_element" class="google_translate"></div>
                    <div class="dropdown">
                        <button class="dropbtn">' . htmlspecialchars($usercredentials["name"]) . '</button>
                        <div class="dropdown-content">
                            <a href="?logout=true">Logout</a>
                        </div>
                    </div>
                </div>';
        }
        ?>
        <!-- <form action="" method="GET">
                        <button class="register" type="submit" name="logout" value="true">Logout</button>
                    </form>    -->
        <!-- <p class="login">' . $usercredentials["name"] . '</p> -->
        <!-- <div>
            <p href=" login.php" class="login" id="loginbtn">Login</p>
            <button class="register" id="registerbtn">Register</button>
        </div> -->

    </div>

</nav>
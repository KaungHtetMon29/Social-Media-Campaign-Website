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
        <div id="mobilenav">
            <div class="mobilenavleft">
                <button class="burgerbtn">
                    <img src="img/menu.png" alt="">
                </button>
                <?php
                if (
                    explode('.', basename($_SERVER['PHP_SELF']))[0] === "popular" ||
                    explode('.', basename($_SERVER['PHP_SELF']))[0] === "index"
                ) {
                    echo '
                    <div class="mobilesearch">
                        <form action="' . (explode(
                            '.',
                            basename($_SERVER['PHP_SELF'])
                        )[0] === "index" ? "popular.php" : "") . '" method="get">
                            <input type="search" placeholder="find popular apps " 
                            name="input" value="' . (isset($_GET["input"]) ? htmlspecialchars($_GET["input"]) : "") . '"/>
                            <button type="submit" class="searchbtn">
                                search
                            </button>
                        </form>
                    </div>';
                }
                ?>
            </div>

            <?php
            if (!isset($_COOKIE["JWT"])) {
                echo
                    '<div class="mobilenavpart">
                    <p href="login.php" class="login" id="mobileloginbtn">Login</p>
                    <button class="register" id="mobileregisterbtn">Register</button>
                </div>';
            }

            if (isset($_COOKIE["credentials"])) {
                $usercredentials = json_decode($_COOKIE["credentials"], true);
                echo
                    '<div class="mobilenavpart">
                        <div id="google_translate_element_mobile" class="google_translate"></div>
                        <div class="dropdown">
                            <button class="dropbtn">' . htmlspecialchars($usercredentials["name"]) . '</button>
                            <div class="dropdown-content">
                                <a href="?logout=true">Logout</a>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <div id="nav_container">
            <a href="index.php" class="nav_ani_op1">Home</a>
            <a href="information.php" class="nav_ani_op1">Information</a>
            <a href="popular.php" class="nav_ani_op1">Popoular</a>
            <a href="tips.php" class="nav_ani_op1">Tips</a>
            <a href="livestream.php" class="nav_ani_op1">Live Stream</a>
            <a href="contact.php" class="nav_ani_op1">Contact</a>
            <a href="legislation.php" class="nav_ani_op1">Legislation and Guidance</a>
            <a href="privacypolicy.php" class="nav_ani_op1">Privacy Policy</a>
            <?php
            if (
                explode('.', basename($_SERVER['PHP_SELF']))[0] === "popular" ||
                explode('.', basename($_SERVER['PHP_SELF']))[0] === "index"
            ) {
                echo '
                <div class="search">
                    <form action="' . (explode(
                        '.',
                        basename($_SERVER['PHP_SELF'])
                    )[0] === "index" ? "popular.php" : "") . '" method="get">
                        <input type="search" placeholder="find popular apps " 
                        name="input" value="' . (isset($_GET["input"]) ? htmlspecialchars($_GET["input"]) : "") . '"/>
                        <button type="submit" class="searchbtn">
                            search
                        </button>
                    </form>
                </div>';
            }
            ?>
        </div>
        <?php
        if (!isset($_COOKIE["JWT"])) {
            echo
                '<div class="">
                    <div id="google_translate_element" class="google_translate"></div>
                    <p href="login.php" class="login navpart" id="loginbtn">Login</p>
                    <button class="register navpart" id="registerbtn">Register</button>
                </div>';
        }
        if (isset($_COOKIE["credentials"])) {
            $usercredentials = json_decode($_COOKIE["credentials"], true);
            echo
                '<div class="">
                    <div id="google_translate_element" class="google_translate"></div>
                    <div class="dropdown navpart">
                        <button class="dropbtn navpart">' . htmlspecialchars($usercredentials["name"]) . '</button>
                        <div class="dropdown-content">
                            <a href="?logout=true">Logout</a>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>

</nav>
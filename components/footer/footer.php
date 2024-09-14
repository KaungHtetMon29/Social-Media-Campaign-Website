<footer>
    <p>
        <?php
        // print_r(explode('.', basename($_SERVER['PHP_SELF']))[0]);
        // print_r(explode("/", explode(".", $_SERVER['PHP_SELF'])[0])[2]);
        echo "You are at " .
            ucfirst(
                explode(
                    '.',
                    basename($_SERVER['PHP_SELF'])
                )[0] === "index" ? "home page" : explode('.', basename($_SERVER['PHP_SELF']))[0] . " page"
            ) . ".";
        ?>
    </p>
    <p>
        Contact us - <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Linkedin</a> |
        <a>Instagram</a>
    </p>
    <p>
        &copy; 2024 SMC All Rights Reserved
    </p>
</footer>
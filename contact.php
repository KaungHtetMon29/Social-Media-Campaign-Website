<?php
require 'components/header/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php
setheader("Contact");
$contacts = [
    [
        "img" => "img/x.png",
        "title" => "Contact from X",
        "content" => "Engage in thought-provoking discussions, share your ideas, and be the first to know about our latest projects.",
    ],
    [
        "img" => "img/Telegram.png",
        "title" => "Contact from Telegram",
        "content" => "Join our exclusive Telegram channel for instant updates, exclusive content, and direct communication with our team.",
    ],
    [
        "img" => "img/instagram.png",
        "title" => "Contact from Instagram",
        "content" => " Immerse yourself in our visually stunning content, from captivating photos to engaging videos.",
    ]
];
function generate_contacts($content)
{
    echo '<div>
            <img src="' . $content['img'] . '" alt="">
            <h3>' . $content['title'] . '</h3>
            <p>
            ' . $content['content'] . '
            </p>
         </div>';
}
?>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <?php include 'components/overlay/overlay.php'; ?>
    <div class="contact">
        <div class="herobg bg bg_gradient mail_form_container">
            <h2>Contact Us!</h2>
            <div class="main">
                <div class="available_contacts">
                    <?php
                    foreach ($contacts as $contact) {
                        generate_contacts($contact);
                    }
                    ?>
                </div>
            </div>

            <form class="mailform" action="utils/php/mailservice.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="msg" id="" cols="30" rows="10" placeholder="Message" required></textarea>
                <button type="submit">Send</button>
            </form>
            <a href="privacypolicy.php">Read Privacy Policy</a>
        </div>
    </div>
    <?php include 'components/footer/footer.php'; ?>
</body>
<script>
    window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        if (status === 'success') {
            alert('Mail sent successfully!');
        } else if (status === 'error') {
            alert('Failed to send mail.');
        }
    };
</script>
<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src=" components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>


</html>
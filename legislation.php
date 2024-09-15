<?php
require 'components/header/header.php';
require 'utils/body_generator/bodygen.php';

$contents = [
    [
        "title" => "Legal Considerations",
        "content" => "Respect copyright laws and avoid sharing copyrighted material without permission. Unauthorized sharing of copyrighted content can lead to legal consequences.
Be mindful of privacy laws and regulations, such as GDPR and CCPA. Protect your personal information and avoid sharing sensitive details that could be misused.
Refrain from making defamatory statements or spreading false information about individuals or organizations. Such actions can have serious legal implications.
Treat others with respect and avoid engaging in harmful online behaviors, such as bullying, harassment, or discrimination.",
        "image" => "img/Legal.png"
    ]
    ,
    [
        "title" => "Ethical Guidelines",
        "content" => "Be genuine and transparent in your online interactions.
        Use polite and respectful language, even in disagreements.Verify the accuracy of information before sharing it.
        Be a responsible digital citizen by contributing positively to online communities.",
        "image" => "img/Ethic.png"
    ],
    [
        "title" => "Best Practices for Online Social Media Use",
        "content" => "Review and adjust your privacy settings on social media platforms to control who can see your information.
        Create strong, unique passwords for all your online accounts. Consider the potential consequences before sharing personal information or sensitive content. 
        Manage your time spent online to maintain a healthy balance. 
        Stay informed about the latest online trends, scams, and security threats.",
        "image" => "img/BPUS.png"
    ]
]; ?>

<!DOCTYPE html>
<html lang="en">
<?php
setheader("Legislation and Guidance");
?>


<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <?php
    $bdygen = new BodyGen($contents);
    $bdygen->generateBody();
    ?>
    <?php include 'components/footer/footer.php'; ?>
</body>
<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>

</html>
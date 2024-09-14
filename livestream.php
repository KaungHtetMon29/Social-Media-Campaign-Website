<?php
require 'components/header/header.php';
require 'utils/body_generator/bodygen.php';
$popular = [
    "title" => "Popular",
    "content" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti voluptatem distinctio aperiam necessitatibus fuga
    officiis nostrum dignissimos odit, obcaecati laudantium ratione unde, quas, quasi tenetur esse. Rem voluptates amet
    omnis!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti voluptatem distinctio aperiam necessitatibus fuga
    officiis nostrum dignissimos odit, obcaecati laudantium ratione unde, quas, quasi tenetur esse. Rem voluptates amet
    omnis!",
    "img" => "https://via.placeholder.com/150"
];
$contents = [$popular, $popular, $popular, $popular, $popular, $popular, $popular]; ?>


<!DOCTYPE html>
<html lang="en">
<?php
setheader("Livestream");
?>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <?php
    $bdygen = new BodyGen($contents, false, true);
    $bdygen->generateBody();
    ?>
    <?php include 'components/footer/footer.php'; ?>
</body>

<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>

</html>
<?php
function setheader(string $pagetitle)
{

    echo '<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>' . $pagetitle . '</title>
  <link rel="stylesheet" href="css/index.css" />
  <script defer type="text/javascript"
    src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script defer src="js/index.js" type="module"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>';
}
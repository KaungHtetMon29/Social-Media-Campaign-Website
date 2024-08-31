<?php
require '../database/dbutil.php';
session_start();
$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$dbinstance->createTable(); ?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>

</body>

</html>
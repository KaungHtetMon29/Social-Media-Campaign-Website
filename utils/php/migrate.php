<?php
require '../../database/dbutil.php';
$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
($dbinstance->createTable());
<?php
include '../../../database/dbutil.php';
$dbinstance = new Dbconnect();
$connection = $dbinstance->connect();
$dbinstance->insert("user", array('user' => "k", 'email' => 'test'));

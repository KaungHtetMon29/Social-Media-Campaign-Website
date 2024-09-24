<?php
require '../../database/dbutil.php';
//we can't use mail server in localhost
//so we store user message on database.
list($sender_email, $subject, $message) = [$_POST["email"], $_POST["subject"], $_POST["msg"]];
$dbconnection = new Dbconnect();
$dbconnection->connect();
$status = $dbconnection->insert(
    'usermessages',
    [
        'sender_email' => $sender_email,
        "subject" => $subject,
        "message" => $message,
        "date" => date("Y-m-d")
    ]
);
if ($status) {

    header("Location: ../../contact.php?status=success");

} else {
    header("Location: ../../contact.php?status=error");
}




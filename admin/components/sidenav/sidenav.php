<?php
$query = $_GET["tab"];
if ($query === "logout") {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
global $user;
?>

<div class="nav">
    <div class="profile">
        <p><?php echo $user["name"] ?></p>
    </div>
    <!-- <a href="#">Admin</a> -->
    <a href="adminpanel.php?tab=user" class=<?php echo $query === "user" ? 'selected_tab' : 'tab' ?>>Users</a>
    <a href="adminpanel.php?tab=admin" class=<?php echo $query === "admin" ? 'selected_tab' : 'tab' ?>>Admin</a>
    <a href="adminpanel.php?tab=information" class=<?php echo $query === "information" ? 'selected_tab' : 'tab' ?>>Information</a>
    <a href="adminpanel.php?tab=popularapp" class=<?php echo $query === "popularapp" ? 'selected_tab' : 'tab' ?>>Popular
        App
    </a>
    <a href="adminpanel.php?tab=usermessages" class=<?php echo $query === "usermessages" ? 'selected_tab' : 'tab' ?>> View
        Message
    </a>
    <a href="adminpanel.php?logout=true" class="pd tab">Logout</a>
    <!-- <a href="#">Posts</a>
    <a href="#">Comments</a> -->
</div>
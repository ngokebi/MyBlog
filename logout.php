<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>/

<?php

$_SESSION["User_ID"] = null;
$_SESSION["username"] = null;
$_SESSION["AdminName"] = null;

session_destroy();

Redirect_to("login.php");

?>
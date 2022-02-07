<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php 

Confirm_Login(); 

?>
<?php

if (isset($_GET["id"])) {

    $searchQuery = $_GET["id"];

    $delete_admin = "DELETE FROM admin WHERE admin_id = '$searchQuery'";

    $run_delete = mysqli_query($connect, $delete_admin);

    if ($run_delete) {
        $_SESSION["SuccessMessage"] = "Admin Deleted Successfully!!";
        Redirect_to("../admin.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!!";
            Redirect_to("../admin.php");
    }
}

?>
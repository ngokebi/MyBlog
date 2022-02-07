<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php 

Confirm_Login(); 

?>
<?php

if (isset($_GET["id"])) {

    $searchQuery = $_GET["id"];

    $delete_cat = "DELETE FROM category WHERE id = '$searchQuery'";

    $run_del = mysqli_query($connect, $delete_cat);

    if ($run_del) {
        $_SESSION["SuccessMessage"] = "Category Deleted Successfully!!";
        Redirect_to("../categories.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!!";
            Redirect_to("../categories.php");
    }
}

?>
<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php 

Confirm_Login(); 

?>
<?php

if (isset($_GET["id"])) {

    $searchQuery = $_GET["id"];

    $delete_comment = "DELETE FROM comments WHERE comment_id = '$searchQuery'";

    $run_delete = mysqli_query($connect, $delete_comment);

    if ($run_delete) {
        $_SESSION["SuccessMessage"] = "Comment Deleted Successfully!!";
        Redirect_to("comments.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!!";
            Redirect_to("comments.php");
    }
}

?>
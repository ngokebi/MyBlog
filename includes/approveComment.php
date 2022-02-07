<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php 

Confirm_Login();

?>
<?php

if (isset($_GET["id"])) {

    $searchQuery = $_GET["id"];

    $admin = $_SESSION["AdminName"];

    $sql_approve = "UPDATE comments SET status = 'ON', approvedby = '$admin' WHERE comment_id = '$searchQuery'";

    $run_approve = mysqli_query($connect, $sql_approve);

    if ($run_approve) {
        $_SESSION["SuccessMessage"] = "Comment Approved Successfully!!";
        Redirect_to("comments.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!!";
            Redirect_to("comments.php");
    }
}

?>
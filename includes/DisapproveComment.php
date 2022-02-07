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

    $sql_disapprove = "UPDATE comments SET status = 'OFF', approvedby = '$admin' WHERE comment_id = '$searchQuery'";

    $run_disapprove = mysqli_query($connect, $sql_disapprove);

    if ($run_disapprove) {
        $_SESSION["SuccessMessage"] = "Comment Disapproved Successfully!!";
        Redirect_to("comments.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!!";
            Redirect_to("comments.php");
    }
}

?>
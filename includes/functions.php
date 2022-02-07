<?php

function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}

function Confirm_Login() {

  if(isset($_SESSION["User_ID"])) {

    return true;

  } else {
    $_SESSION["ErrorMessage"] = "Login Required!!";
    Redirect_to("login.php");
  }
}

function TotalPost() {
  
  include "config.php";

  $sql_post = "SELECT COUNT(*) FROM post";

  $run_post = mysqli_query($connect,$sql_post);

  $total_post = mysqli_fetch_array($run_post);

  $post = array_shift($total_post);
  
  echo $post;

}

function TotalCat() {

  include "config.php";

  $sql_category = "SELECT COUNT(*) FROM category";

  $run_category = mysqli_query($connect,$sql_category);

  $total_category = mysqli_fetch_array($run_category);

  $category = array_shift($total_category);
  
  echo $category;

}

function TotalAdmin() {

  include "config.php";

  $sql_admin = "SELECT COUNT(*) FROM admin";

  $run_admin = mysqli_query($connect,$sql_admin);

  $total_admin = mysqli_fetch_array($run_admin);

  $admin = array_shift($total_admin);

  echo $admin;

}

function TotalComment() {

  include "config.php";

  $sql_comment = "SELECT COUNT(*) FROM comments";

  $run_comment = mysqli_query($connect,$sql_comment);

  $total_comment = mysqli_fetch_array($run_comment);

  $comment = array_shift($total_comment);
  
  echo $comment;

}

function ApproveCommentAccordingtoPost($Post_ID) {

  include "config.php";

  $sql_approve = "SELECT COUNT(*) FROM comments WHERE post_id = '$Post_ID' AND status = 'ON'";

  $run_approve = mysqli_query($connect, $sql_approve);

  $show_approve = mysqli_fetch_array($run_approve);

  $total_approve = array_shift($show_approve);

  return $total_approve;

}

function DisapproveCommentAccordingtoPost($Post_ID) {

  include "config.php";

  $sql_disapprove = "SELECT COUNT(*) FROM comments WHERE post_id = '$Post_ID' AND status = 'OFF'";

  $run_disapprove = mysqli_query($connect, $sql_disapprove);

  $show_disapprove = mysqli_fetch_array($run_disapprove);

  $total_disapprove = array_shift($show_disapprove);

  return $total_disapprove;
}
?>


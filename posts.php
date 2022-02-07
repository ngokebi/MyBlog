<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>
<?php 

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];

Confirm_Login();

?>

<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel = "stylesheet" href = "css/styles.css">
    <title> Posts </title>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container">
            <a href = "blog.php?page=1" target= "_blank" class = "navbar-brand" style = "font-family:Book Antiqua;"> Ngblog </a>
            <button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navbarcollapseMENU">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class = "collapse navbar-collapse" id = "navbarcollapseMENU">
                <ul class = "navbar-nav mr-auto">
                    <li class = "nav-item">
                        <a href  = "myprofile.php" class = "nav-link" style = "font-family:Book Antiqua;"><i class="fas fa-user text-success"></i> My Profile </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "dashboard.php" class = "nav-link" style = "font-family:Book Antiqua;"> Dashboard </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "posts.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Posts </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "categories.php" class = "nav-link" style = "font-family:Book Antiqua;"> Categories</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "admin.php" class = "nav-link" style = "font-family:Book Antiqua;"> Manage Admins</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "includes/comments.php" class = "nav-link" style = "font-family:Book Antiqua;"> Comments</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "blog.php?page=1" target= "_blank" class = "nav-link" style = "font-family:Book Antiqua;" > Live BLog</a>
                    </li>
                </ul>
                <ul class = "navbar-nav ml-auto">
                    <li class = "nav-item">
                        <a href = "logout.php" class = "nav-link" style = "font-family:Book Antiqua;"><i class="fas fa-user-times text-danger"></i> Logout</a>
                    </li>
                </div>
        </div>
    </nav>
<div style = "height: 10px; background: #27AAE1;"></div>
<!--NAVBAR END -->
<!-- HEADER -->
<header class = "bg-dark text-white py-3">
<div class = "container">
    <div class = "row">
        <div class = "col-md-12 mb-3">
    <h1 style = "font-family: Broadway;"><i class = "fas fa-blog" style = "color: #27AAE1;"></i> Blog Posts </h1>
        </div>
        <div class = "col-lg-3 mb-2">
            <a href = "new_post.php" class = "btn btn-primary btn-block" style = "font-family:Book Antiqua;">
                <i class = "fas fa-edit"></i> New Post
            </a>
        </div>
        <div class = "col-lg-3 mb-2">
            <a href = "categories.php" class = "btn btn-info btn-block" style = "font-family:Book Antiqua;">
                <i class = "fas fa-folder-plus"></i> New Category
            </a>
        </div>
        <div class = "col-lg-3 mb-2">
            <a href = "admin.php" class = "btn btn-warning btn-block" style = "font-family:Book Antiqua;">
                <i class = "fas fa-user-plus"></i> New Admin
            </a>
        </div>
        <div class = "col-lg-3 mb-2">
            <a href = "includes/comments.php" class = "btn btn-success btn-block" style = "font-family:Book Antiqua;">
                <i class = "fas fa-check"></i> Approve Comments
            </a>
        </div>
    </div>
</div>
</header>
<section class = "container py-2 mb-4">
<div class = "row">
    <div class = "col-lg-12">
    <?php 
                echo ErrorMessage();
                echo SuccessMessage();
            ?>
        <table class = "table table-striped table-hover">
        <thead class = "thead-dark">
            <tr style = "font-family:Broadway">
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date&TIme</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Comments</th>
                <th>Action</th>
                <th>Live Preview</th>
            </tr>
        </thead>
<?php

if(isset($_GET["page"])) {
$page = $_GET["page"];
if ($page == 0 || $page < 1) {       
$showPostFrom = 0;
    } else {
$showPostFrom = ($page*4)-4;
    }
$view_post = "SELECT * FROM post ORDER BY post_id DESC LIMIT $showPostFrom,4"; 

$run_view_post = mysqli_query($connect,$view_post);

$id = 0;

while($show_post = mysqli_fetch_array($run_view_post)) {
    $Id = $show_post["post_id"];
    $title = $show_post["post_title"];
    $category = $show_post["category"];
    $DateTime = $show_post["datetime"];
    $author = $show_post["post_author"];
    $image = $show_post["post_image"];
    $posttext = $show_post["post_content"];
    $id++;

?> 
        <tbody>
            <tr style = "font-family:Century Gothic">
                <td><?php echo htmlentities($id); ?></td>
                <td><?php echo htmlentities($title); ?></td>
                <td><?php echo htmlentities($category); ?></td>
                <td><?php echo htmlentities($DateTime); ?></td>
                <td><?php echo htmlentities($author); ?></td>
                <td><img src = "images/<?php echo htmlentities($image); ?>" width = "170px" height = "120px"></td>
                <td> 
                    <?php

                    $total_approve = ApproveCommentAccordingtoPost($Id);
                    
                    if ($total_approve > 0) {
                    
                    ?>
                <span class = "badge badge-success" title = "Approve">
                    <?php

                    echo $total_approve;

                    ?>

                    </span>

                    <?php } ?>

                    <?php

                    $total_disapprove = DisapproveCommentAccordingtoPost($Id);

                    if ($total_disapprove > 0) {
                    
                    ?>
                <span class = "badge badge-danger" title = "Disapprove">
                    <?php

                    echo $total_disapprove;

                    ?>

                    </span>

                    <?php } ?>
            </td>
                <td><a href="includes/editpost.php?id=<?php echo $Id; ?>" title = "Edit"><span class = "fas fa-pencil-alt"></span></a>
                    &nbsp;&nbsp;
                    <a href="includes/deletepost.php?id=<?php echo $Id; ?>" title = "Delete"><span class = "fas fa-trash-alt"></span></a>
                </td>
                <td>
                    <a href="fullpost.php?id=<?php echo $Id; ?>" target = "_blank"><span class = "btn btn-info btn-block"> Live Preview </span></a>
                </td>
            </tr>  
        </tbody>
<?php } }?>
        </table>
    </div>
</div>
<nav aria-label="Page navigation example">
<ul class="pagination pagination-lg justify-content-center">
<!-- create backward button -->
    <?php
        if(isset($page)) {
            if ($page>1) {
    ?>
    <li class="page-item">
    <a href="posts.php?page=<?php echo $page-1; ?>" class="page-link"> &laquo; </a>
    </li>
    <?php } } ?>

    <?php
                    
    $count = "SELECT COUNT(*) FROM post";
    $run_count = mysqli_query($connect, $count);
    $fetch_count = mysqli_fetch_array($run_count);
    $show_count = array_shift($fetch_count);
    $show_count."<br>";
    $postPagination = $show_count/4;
    $postPagination = ceil($postPagination);
    $postPagination;
    for ($i=1; $i <= $postPagination; $i++) { 
        if (isset($page)) {
            if ($i == $page) {
    ?>
    <li class="page-item active">
    <a href="posts.php?page=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> </a>
    </li> 
<?php
} else {
?>
<li class="page-item">
<a href="posts.php?page=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> </a>
</li> 
<?php } } } ?>
<!-- create forward button -->
<?php
if(isset($page) && !empty($page)) {
if ($page+1 <= $postPagination) {
?>
<li class="page-item">
<a href="posts.php?page=<?php echo $page+1; ?>" class="page-link"> &raquo; </a>
</li>
<?php } } ?>
</ul>
</nav>
</section>

<!-- END HEADER --> 
<!-- FOOTER --> 
<footer class = "bg-dark text-white" style = "font-family:Century Gothic;">
    <div class = "container">
        <div class = "row">
            <div class = "col">
            <p class = "lead text-center">Theme by | NgBlog | <span id = "year"></span> &copy; -----All right Reserved. </p>
            <p class = "text-center small"><a style = "color: white; text-decoration: none; cursor: pointer;" href= "https://ngblog.com/coupons/" target = "_blank">
            This is the Offical Site fot the Ngblog Society<br> &trade; NgBlog.com &trade; Facebook</a></p>
            </div>
        </div>
    </div>
</footer>
<div style = "height: 10px; background: #27AAE1;"></div>
<!-- END FOOTER -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
    $("#year").text(new Date().getFullYear());
</script>
</body>
</html>
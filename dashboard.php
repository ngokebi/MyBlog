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
    <title> Dashboard </title>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container">
            <h1 class="navbar-brand" style = "font-family:Century Gothic;color:darkgray;"><strong><i> NewsLive </i></strong></h1>  
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
                        <a href  = "blog.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;" > Live BLog</a>
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
    <h1 style = "font-family: Broadway;"><i class = "fas fa-cog" style = "color: #27AAE1;"></i> Dashboard </h1>
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
<br>
<section class = "container py-2 mb-4">
<div class = "row">
        
<!-- left side area starts -->
    <div class = "col-lg-2 d-none d-md-block">
        <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
                <h1 class="lead FieldInfo"> Posts </h1>
                <h4 class="display-5 FieldInfo">
                    <i class="fab fa-readme" style = "color: #27AAE1;">
                    </i>
                    &nbsp;
                    <?php TotalPost(); ?>
                </h4>
            </div>
        </div>
        <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
                <h1 class="lead FieldInfo"> Categories </h1>
                <h4 class="display-5 FieldInfo">
                    <i class="fas fa-folder" style = "color: #27AAE1;">
                    </i>
                    &nbsp;
                    <?php TotalCat(); ?>
                </h4>
            </div>
        </div>
        <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
                <h1 class="lead FieldInfo"> Admins </h1>
                <h4 class="display-5 FieldInfo">
                    <i class="fas fa-users" style = "color: #27AAE1;">
                    </i>
                    &nbsp;
                    <?php TotalAdmin(); ?>
                </h4>
            </div>
        </div>
        <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
                <h1 class="lead FieldInfo"> Comments</h1>
                <h4 class="display-5 FieldInfo">
                    <i class="fas fa-comments" style = "color: #27AAE1;">
                    </i>
                    &nbsp;
                    <?php TotalComment(); ?>
                </h4>
            </div>
        </div>
    </div>
<!-- left side area ends -->
<!-- right side area starts -->
    <div class="col-lg-10">
    <?php 
                echo ErrorMessage();
                echo SuccessMessage();
        ?>
        <h1 style="font-size:50px; color:darkgray; font-family:Broadway;"> Top Posts </h1>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th> No. </th>
                    <th> Title </th>
                    <th> Author </th>
                    <th> Date&Time </th>
                    <th> Comments </th>
                    <th> Details </th>
                </tr>
            </thead>
            <?php

                $SrNo = 0;

                $sql_show = "SELECT * FROM post ORDER BY post_id DESC LIMIT 0,5";

                $run_show = mysqli_query($connect, $sql_show);

                while ($sql_display = mysqli_fetch_array($run_show)) {

                    $Post_ID = $sql_display["post_id"];
                    $title = $sql_display["post_title"];
                    $author = $sql_display["post_author"];
                    $datetime = $sql_display["datetime"];
                    $SrNo++;
            ?>
            <tbody>
                <tr>
                    <td> <?php echo $SrNo; ?></td>
                    <td> <?php echo $title; ?></td>
                    <td> <?php echo $author; ?></td>
                    <td> <?php echo $datetime; ?></td>
                    <td> 
                            <?php

                            $total_approve = ApproveCommentAccordingtoPost($Post_ID);
                            
                            if ($total_approve > 0) {
                            
                            ?>
                        <span class = "badge badge-success" title = "Approve">
                            <?php

                            echo $total_approve;

                            ?>

                            </span>

                            <?php } ?>

                            <?php

                            $total_disapprove = DisapproveCommentAccordingtoPost($Post_ID);

                            if ($total_disapprove > 0) {
                            
                            ?>
                        <span class = "badge badge-danger" title = "Disapprove">
                            <?php

                            echo $total_disapprove;

                            ?>

                            </span>

                            <?php } ?>
                    </td>
                    <td> 
                        <a href = "fullpost.php?id=<?php echo $Post_ID; ?>" target = "_blank"><span class="btn btn-info"> Preview </span></a>
                    </td>
                </tr>
            </tbody>
                <?php } ?>
        </table>
    </div>
<!-- right side area ends -->
</div>
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
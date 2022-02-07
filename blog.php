<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>

<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel = "stylesheet" href = "css/styles.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<title> NewsLive </title>
    <style media = "screen">
        .heading {
    font-family:"Century Gothic";
    font-weight: bold;
    
}
.heading:hover {
    color: lightblue;
}
    </style>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container-fluid">
        <h1 class="navbar-brand" style = "font-family:Century Gothic;color:darkgray;"><strong><i> NewsLive </i></strong></h1>  
            <button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navbarcollapseMENU">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class = "collapse navbar-collapse" id = "navbarcollapseMENU">
                <ul class = "navbar-nav mr-auto">
                    <li class = "nav-item">
                        <a href  = "blog.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Home </a>
                    </li>
                    &nbsp;&nbsp;
                    <li class = "nav-item">
                    <?php

                    $cat = "SELECT * FROM category ORDER BY id DESC";

                    $run_cat = mysqli_query($connect, $cat);

                    while($show_cat = mysqli_fetch_array($run_cat)) {

                        $cat_id = $show_cat["id"];
                        $cat_title = $show_cat["title"];
                    }
                    ?>
                        <a href  = "blog.php?category=<?php echo $cat_title; ?>" class = "nav-link" style = "font-family:Book Antiqua;"> About Us </a>
                    </li>
                    &nbsp;&nbsp;
                    <li class = "nav-item">
                        <a href  = "blog.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Blog </a>
                    </li>
                    &nbsp;&nbsp;
                    <li class = "nav-item">
                        <a href  = "#" class = "nav-link" style = "font-family:Book Antiqua;"> Contact Us </a>
                    </li>
                    &nbsp;&nbsp;
                    <li class = "nav-item">
                        <a href  = "#" class = "nav-link" style = "font-family:Book Antiqua;"> Features</a>
                    </li>
                </ul>
                </div>
        </div>
    </nav>
<div style = "height: 10px; background: #27AAE1;"></div>
<!--NAVBAR END -->
<!-- HEADER -->
<div class = "container">
    <div class = "row mt-4">

        <!-- Main Area Starts -->
        <div class = "col-sm-8">
            <!-- <h1>The Latest on Sport</h1>
            <h1 class = "lead">Live Updates all across the World</h1> -->
            <?php 
                echo ErrorMessage();
                echo SuccessMessage();
            ?>
            <?php

            // Query when search butoon is active 

            if(isset($_GET["SearchButton"])) {

                $search = $_GET["search"];

                $allPost = "SELECT * FROM post WHERE post_title LIKE '%$search%' OR category LIKE '%$search%' OR post_author LIKE '%$search%' OR post_keyword LIKE '%$search%' OR datetime LIKE '%$search%'";

                $runPost = mysqli_query($connect,$allPost);

                // Query when pagination is active 

                } elseif(isset($_GET["page"])) {

                    $page = $_GET["page"];

                    if ($page == 0 || $page < 1) {
                       
                        $showPostFrom = 0;

                    } else {

                    $showPostFrom = ($page*4)-4;

                    }

                    $sql = "SELECT * FROM Post ORDER BY post_id DESC LIMIT $showPostFrom,4";

                    $runPost = mysqli_query($connect,$sql);

                    // Query when category is active 

                } elseif (isset($_GET["category"])) {

                    $category = $_GET["category"];

                    $category_get = "SELECT * FROM post WHERE category = '$category' ORDER BY post_id DESC";

                    $runPost = mysqli_query($connect, $category_get);
                    
                }

                // Default SQL Query 

            else {
                
            $allPost = "SELECT * FROM post ORDER BY post_id DESC LIMIT 0,4";

            $runPost = mysqli_query($connect,$allPost);

            }

            while ($showPost = mysqli_fetch_array($runPost)){

                $Id = $showPost["post_id"];
                $title = $showPost["post_title"];
                $category = $showPost["category"];
                $image = $showPost["post_image"];
                $author = $showPost["post_author"];
                $content = $showPost["post_content"];
                $date = $showPost["datetime"];
            
            
            ?>
            <div class = "card mb-3">
                <a href="fullpost.php?id=<?php echo $Id; ?>"> <img src = "images/<?php  echo htmlentities($image); ?>" style = "width:auto; max-height:fit-content;" class = "img-fluid card-img-top" /></a>
                <div class = "card-body">
                    <a href = "fullpost.php?id=<?php echo $Id; ?>"><h4 class = "card-title text-info" style="font-family: Book Antiqua;"> <?php echo htmlentities($title); ?></h4></a>
                    <small class = "text-muted" style="font-family: Book Antiqua;"> Category: <span class="text-dark"><strong><?php echo $category; ?>.</strong></span> Written by <span class="text-dark"><strong><?php echo $author; ?></strong></span> On <span class="text-dark"><strong><?php echo htmlentities($date); ?></strong></span></small>
                    <span style = "float:right; font-family: Book Antiqua;" class = "badge badge-dark text-light">Comments :&nbsp; 
                    <?php
                    echo ApproveCommentAccordingtoPost($Id);
                    ?>
                    </span>
                    <hr>
                    <p class = "card-text" style="font-family: Book Antiqua;">
                        <?php 
                        if (strlen($content)>400) {
                            $content = substr($content,0,600)."...";
                        }
                        echo strip_tags($content); 
                        ?>
                    </p>
                </div> 
            </div>  
            <?php } ?>   

            <!--Pagination -->
            <nav>
                <ul class="pagination pagination-lg justify-content-center">

                <!-- create backward button -->
                <?php
                    
                if(isset($page)) {

                if ($page>1) {

                ?>
                <li class="page-item">
                    <a href="blog.php?page=<?php echo $page-1; ?>" class="page-link"> &laquo; </a>
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
                        <a href="blog.php?page=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> </a>
                    </li> 

                    <?php

                            } else {

                    ?>

                        <li class="page-item">
                        <a href="blog.php?page=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> </a>
                    </li> 
                        
                    <?php } } } ?>

                    <!-- create forward button -->
                    <?php
                    
                    if(isset($page) && !empty($page)) {

                        if ($page+1 <= $postPagination) {

                    ?>
                    <li class="page-item">
                        <a href="blog.php?page=<?php echo $page+1; ?>" class="page-link"> &raquo; </a>
                    </li>
                    <?php } } ?>
                </ul>
            </nav>
        </div>
        <!-- Main Area Ends -->

        <!-- Side Area Starts -->
        <div class="col-sm-4">
    <form class="card card-sm" action = "blog.php">
        <div class="card-body row no-gutters align-items-center">
            <div class="col-auto">
                <i class="fas fa-search"></i>
            </div>
            &nbsp;&nbsp;
            <div class="col">
                <input class="form-control form-control-borderless" name = "search" type="search" placeholder="Search....">
            </div>
            &nbsp;
            <div class="col-auto">
                <button class="btn btn-success" name = "SearchButton">Search</button>
            </div>
        </div>
    </form> 
        <div class="card mt-4"> 
            <div class="card-body">
                <img src="images/startblog.png" class="d-block img-fluid mb-3" alt="">
                <div class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header bg-info text-white">
                <h2 class="lead"> Sign Up! </h2>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-success btn-block text-center text-white" name="button"> Join the Forum </button>
                <a href="includes/user_login.php"><button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button"> Login </button></a>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="" placeholder="enter your email" value="">
                    &nbsp;
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button"> Subscribe Now </button>
                    </div>
                </div>
            </div>
        </div>
<br>
        <div class="card">
            <div class="card-header bg-info text-white">
            <h2 class="lead"> Categories </h2>
            </div>
                <div class="card-body">
                    <?php

                    $cat = "SELECT * FROM category ORDER BY id DESC";

                    $run_cat = mysqli_query($connect, $cat);

                    while($show_cat = mysqli_fetch_array($run_cat)) {

                        $cat_id = $show_cat["id"];
                        $cat_title = $show_cat["title"];

                    ?>
                    <a href="blog.php?category=<?php echo $cat_title; ?>" style = "color:grey;"><span class="heading"> <?php echo $cat_title; ?> </span></a><br>
                    <?php } ?>
                </div>
            </div>
        <br>
        <div class = "card">
            <div class = "card-header bg-info text-white">
            <h2 class = "lead"> Follow Us!!! </h2>
            </div>
                <div class = "card-body">
                    <a href="https://www.facebook.com" target="_blank"><img src="images/facebook.jpg"  width="50px" height="50px"/></a>
                    <a href="http://www.twitter.com" target="_blank"> <img src="images/twitter-logo.png" width="50px" height="50px"/></a>
                    <a href="http://www.twitter.com" target="_blank"> <img src="images/google.png" width="50px" height="50px"/></a>
                    <a href="http://www.twitter.com" target="_blank"> <img src="images/insta.jpg" width="50px" height="50px"/></a>
                </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header bg-info text-white">
                <h2 class="lead"> Recent Posts </h2>           
            </div>
            <div class="card-body">
                <?php
                
                $recent = "SELECT * FROM post ORDER BY post_id DESC LIMIT 0,4";

                $run_recent = mysqli_query($connect, $recent);

                while($show_recent = mysqli_fetch_array($run_recent)) {

                    $Id = $show_recent["post_id"];
                    $title = $show_recent["post_title"];
                    $datetime = $show_recent["datetime"];
                    $image = $show_recent["post_image"];
                ?>
                <div class = "media">
                    <img src = "images/<?php echo htmlentities($image); ?>" class = "d-block img-fluid align-self-start" width = "150px" height = "150px" alt = "">
                    <div class = "media-body ml-2">
                        <a href = "fullpost.php?id=<?php echo $Id; ?>" target = "_blank" ><h6 class="card-title text-info"><?php echo htmlentities($title); ?></h6></a>
                        <small><p class = "small"><i><?php echo htmlentities($datetime); ?></i></p></small>
                    </div>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>                  
    </div>
        <!-- Side Area ends -->
    </div>
</div>
<!-- END HEADER --> 
<br>
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
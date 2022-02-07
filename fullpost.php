<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>
<?php $SearchQuery = $_GET["id"]; ?>
<?php $postIDfromURL = $_GET["id"]; ?>

<?php

if(isset($_POST["Submit"])) {

    $name = $_POST["commentname"];
    $email = $_POST["commentemail"];
    $comment = $_POST["commentthoughts"];
    $approval = "pending";
    $status = "OFF";
    date_default_timezone_set("Africa/Lagos");
    $time = time();
    $date = date("F d, Y h:i:s a", $time);

    if (empty($name) || empty($email) || empty($connect)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("fullpost.php?id=$SearchQuery");
    } elseif (strlen($comment) > 5000) {
        $_SESSION["ErrorMessage"] = "Comment Lenght too Long";
        Redirect_to("fullpost.php?id=$SearchQuery");
    } else {
        $insert_comment = "INSERT INTO comments (name, email, comment, approvedby, status, post_id, datetime) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($connect, $insert_comment)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_email, $param_comment, $param_approval, $param_status, $param_postid, $param_datetime);

         $param_name = $name;
         $param_email = $email;
         $param_comment = $comment;
         $param_approval = $approval;
         $param_status = $status;
         $param_postid = $postIDfromURL;
         $param_datetime = $date;

        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["SuccessMessage"] = "Comment Submitted Successfully.";
            Redirect_to("fullpost.php?id=$SearchQuery");
            exit();
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Please try again later.";
            Redirect_to("fullpost.php?id=$SearchQuery");
            }

        }
        mysqli_stmt_close($stmt);

    }
}

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
    <title> 
        <?php 
        $sql = "SELECT post_title FROM post WHERE post_id = '$postIDfromURL'";
        $run_sql = mysqli_query($connect,$sql);
        while($show_sql = mysqli_fetch_array($run_sql)) {
            $title = $show_sql["post_title"];
            echo $title; 
        }
        ?>
    </title>
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
                        <a href  = "#" class = "nav-link" style = "font-family:Book Antiqua;"> About Us </a>
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
            <?php echo ErrorMessage();
                  echo SuccessMessage();
            ?>
            <?php
            
            if(isset($_GET["SearchButton"])) {

                $search = $_GET["search"];

                if($search == "") {
                    $_SESSION["ErrorMessage"] = "All fields must be filled out";
                    Redirect_to("blog.php");

                } else {

                $allPost = "SELECT * FROM post WHERE post_title LIKE '%$search%' OR category LIKE '%$search%' OR post_author LIKE '%$search%' OR post_keyword LIKE '%$search%' OR datetime LIKE '%$search%' OR post_content LIKE '%$search%'";

                $runPost = mysqli_query($connect,$allPost);

                }

            }

            else {
                
            $IDfromURL = $_GET["id"];

            if(!isset($IDfromURL)) {

                $_SESSION["ErrorMessage"] = "Bad Request!";
                Redirect_to("blog.php");

            }

            $allPost = "SELECT * FROM post WHERE post_id= '$IDfromURL'";

            $runPost = mysqli_query($connect,$allPost);

            if (mysqli_num_rows($runPost) !== 1) {

                $_SESSION["ErrorMessage"] = "Bad Request!";
                Redirect_to("blog.php?page=1");
            }

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
            <div class = "card">
                <img src = "images/<?php  echo htmlentities($image); ?>" style = "max-height:fit-content" class = "img-fluid card-img-top" />
                <div class = "card-body">
                    <h4 class = "card-title" style="font-family:Book Antiqua; color:CadetBlue;"> <?php echo htmlentities($title); ?></h4>
                    <small class = "text-muted" style="font-family: Book Antiqua;"> Category: <span class="text-dark"><strong><?php echo $category; ?>.</strong></span> Written by <span class="text-dark"><strong><?php echo $author; ?></strong></span> On <span class="text-dark"><strong><?php echo htmlentities($date); ?></strong></span></small>
                    <hr>
                    <p class = "card-text" >
                        <?php
                            echo $content; 
                        ?>
                    </p>
                </div>
                
            </div>
                    
            <?php } ?>
            <hr>
            <!--Comment Part Start -->
            <!--Fetching Existing Comment Start -->
            <span class = "HeaderInfo"><strong><i> Comments: </i></strong></span>
            <br><br>
            <?php
            
            $sql_comment = "SELECT * FROM comments WHERE post_id = '$SearchQuery' AND status = 'ON'";

            $run_comment = mysqli_query($connect, $sql_comment);

            while($show_comment = mysqli_fetch_array($run_comment)) {
                $CommentDate = $show_comment["datetime"];
                $CommentName = $show_comment["name"];
                $CommentContent = $show_comment["comment"];

            ?>
<div>
    
    <div class = "media CommentBlock">
    <img class = "d-block img-fluid align-self-start" src = "images/comment.png" alt="">
        <div class = "media-body CommentInfo ml-2">
            <h6 class = "lead"><i><strong><?php echo $CommentName; ?></strong></i></h6>
            <p class = "small"><?php echo $CommentDate; ?></p>
            <p class = "medium"><?php echo $CommentContent; ?></p>
        </div>
    </div>
</div>
<hr>
            <?php } ?>
            <!--Fetching Existing Comment Ends -->

<div>
    <form action="fullpost.php?id=<?php echo $SearchQuery; ?>" method = "post">
    <div class = "card mb-3">
        <div class="card-header">
            <h5 class = "HeaderInfo"><strong> Share your thoughs about this post </strong></h5>
        </div>
        <div class = "card-body"> 
            <div class = "form-group">
                <div class = "input-group">
                    <div class = "input-group-prepend">
                        <span class="input-group-text"><i class = "fas fa-user"></i></span>
                    </div>
                <input class = "form-control" type = "text" name = "commentname" placeholder = "Name" value = "">
                </div>
            </div>
            <div class = "form-group">
                <div class = "input-group">
                    <div class = "input-group-prepend">
                        <span class="input-group-text"><i class = "fas fa-envelope"></i></span>
                    </div>
                <input class = "form-control" type = "email" name = "commentemail" placeholder = "Email" value = "">
                </div>
            </div>
            <div class = "form-group">
                <textarea class = "form-control" name = "commentthoughts" cols="80" rows="10"></textarea>
            </div>
            <div>
                <button type = "submit" name = "Submit" class = "btn btn-primary"> Comment</button>
            </div>
        </div>
    </div> 
    </form>
</div>
            <!--Comment Part End -->
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
            <div class="card-header bg-info text-light">
                <h2 class="lead"> Sign Up! </h2>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-success btn-block text-center text-white" name="button"> Join the Forum </button>
                <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button"> Login </button>
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
</header>
<br>
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
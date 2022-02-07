<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>
<?php 

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];

Confirm_Login(); ?>

<?php

if(isset($_POST["Submit"])) {
    
    $post_title = $_POST["post_title"];
    $cat = $_POST["category"];
    $post_image = $_FILES["post_image"]["name"];
    $post_image_tmp = $_FILES["post_image"]["tmp_name"];
    #$target = "Uploads/".basement($_FILES["image"]["name"]);
    $post_author = $_POST["post_author"];
    $post_keyword = $_POST["post_keyword"];
    $post_content = $_POST[strip_tags("post_content")];
    $admin = $_SESSION["AdminName"];
    date_default_timezone_set("Africa/Lagos");
    $time = time();
    $date = date("F d, Y h:i:s a", $time);

    if ($post_title == "") {
        $_SESSION["ErrorMessage"] = "Title can't be Empty";
        Redirect_to("new_post.php");
    } 
    if ($cat == "null") {
        $_SESSION["ErrorMessage"] = "Select a Category";
        Redirect_to("new_post.php");
    }
    if ($post_image == "") {
        $_SESSION["ErrorMessage"] = "No image Selected";
        Redirect_to("new_post.php");
    }
    if ($post_author == "") {
        $_SESSION["ErrorMessage"] = "Who's the Author";
        Redirect_to("new_post.php");
    }
    if ($post_content == "") {
        $_SESSION["ErrorMessage"] = "This Field can't be Empty";
        Redirect_to("new_post.php");
    }
    if (strlen($post_content) > 1000000) {
        $_SESSION["ErrorMessage"] = "Content too Long";
        Redirect_to("new_post.php");
    }
    else {
        move_uploaded_file($post_image_tmp,"images/$post_image");
        $insert_post = "INSERT INTO post (post_title, category, post_image, post_author, post_keyword, post_content, datetime) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($connect, $insert_post)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $param_title, $param_category, $param_image, $param_author, $param_keyword, $param_content, $param_datetime);

         $param_title = $post_title;
         $param_category = $cat;
         $param_image = $post_image;
         $param_author = $post_author;
         $param_keyword = $post_keyword;
         $param_content = $post_content;
         $param_datetime = $date;

        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["SuccessMessage"] = "Post Added Successfully.";
            Redirect_to("posts.php?page=1");
            exit();
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Please try again later.";
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
    <title> New Posts </title>
    <script src="https://cdn.tiny.cloud/1/96mnsk10pkg2eoqov5j9uvwckxdsvqkplraribk3dkypc1fi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({selector:'textarea'});
    </script>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container">
            <a href = "blog.php?page=1" class = "navbar-brand" style = "font-family:Book Antiqua;"> Ngblog </a>
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
                        <a href  = "comments.php" class = "nav-link" style = "font-family:Book Antiqua;"> Comments</a>
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
        <div class = "col-md-12">
    <h1 style = "font-family: Broadway;"><i class = "fas fa-edit" style = "color: #27AAE1;"></i> New Post </h1>
        </div>


    </div>
</div>
</header>
<br>
<!-- END HEADER --> 
<!-- Main Area -->

<section class = "container py-2 mb-4">
    <div class = "row">
        <div class = "offset-lg-1 col-lg-10"style = "min-height: 400px;">
            <?php echo ErrorMessage();
                  echo SuccessMessage();
            ?>
            <form action = "new_post.php" method = "post" enctype = "multipart/form-data">
                <div class = "card bg-secondary text-dark mb-3">
    <div class = "card-body bg-dark">
        <div class = "form-group mb-1">
            <label for = "title"><span class = "FieldInfo"> Post Title: </span></label>
                <input class = "form-control" type = "text" name = "post_title" id = "title" value = "" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group">
            <label for = "CategoryTitle"><span class = "FieldInfo"> Choose Category: </span></label>
                <select class = "form-control" id = "CategoryTItle" name = "category">
                    <option value = "null"> Select a Category </option>
                    <?php
                    
                    $get_cats = "SELECT * FROM category";
                    
                    $run_cats = mysqli_query($connect,$get_cats);
                    
                    while ($cats_row = mysqli_fetch_array($run_cats)){
                        
                        $cat_id = $cats_row["id"]; 
                        $cat_title = $cats_row["title"];
                    
                    ?>  

                    <option><?php echo $cat_title; ?></option>

                    <?php } ?>
                </select>
        </div>
        <div class = "form-group mb-1">
            <div class = "custom-file">
                <input class = "custom-file-input" type = "file" name = "post_image" id = "imageSelect" value = "">
                    <label for = "imageSelect" class = "custom-file-label"> Select Image </label>
            </div>
        </div>
        <div class = "form-group mb-1">
            <label for = "author"><span class = "FieldInfo"> Post Author: </span></label>
                <input class = "form-control" type = "text" name = "post_author" id = "author" value = "" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group mb-1">
            <label for = "keyword"><span class = "FieldInfo"> Post Keyword: </span></label>
                <input class = "form-control" type = "text" name = "post_keyword" id = "keyword" value = "" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group mb-1">
            <label for = "content"><span class = "FieldInfo"> Post Content: </span></label>
               <textarea class = "form-control" id = "content" name = "post_content" rows = "8" cols = "80"></textarea>
        </div>
            <div class = "row">
                <div class = "col-lg-6 mb-2">
                    <a href = "dashboard.php" class = "btn btn-warning btn-block" style = "font-family: Century Gothic;"><i class = "fas fa-undo-alt"></i> Back to Dashboard </a>
                </div>

                <div class = "col-lg-6 mb-2">
                    <button type = "submit" name = "Submit" class = "btn btn-success btn-block" style = "font-family: Century Gothic;">
                        <i class = "fas fa-check"></i> Add Post
                    </button>
            </div>
                </div>
    </div>
                </div>
           </form>
        </div>
    </div>

</section>

<!-- ENd Main Area -->
<!-- FOOTER --> 
<footer class = "bg-dark text-white">
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
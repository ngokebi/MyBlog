<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php Confirm_Login(); ?>

<?php

$searchParameter = $_GET["id"];

if(isset($_POST["Submit"])) {
    
    $post_title = $_POST["post_title"];
    $cat = $_POST["category"];
    $post_image = $_FILES["post_image"]["name"];
    $post_image_tmp = $_FILES["post_image"]["tmp_name"];
    #$target = "Uploads/".basement($_FILES["image"]["name"]);
    $post_author = $_POST["post_author"];
    $post_keyword = $_POST["post_keyword"];
    $post_content = $_POST["post_content"];
    date_default_timezone_set("Africa/Lagos");
    $admin = $_SESSION["AdminName"];
    $time = time();
    $date = date("F d, Y h:i:s a", $time);

    if ($post_title == "") {
        $_SESSION["ErrorMessage"] = "Title can't be Empty";
        Redirect_to("editpost.php?id=$searchParameter");
    } 
    if ($cat == "null") {
        $_SESSION["ErrorMessage"] = "Select a Category";
        Redirect_to("editpost.php?id=$searchParameter");
    }
    if ($post_author == "") {
        $_SESSION["ErrorMessage"] = "Who's the Author";
        Redirect_to("editpost.php?id=$searchParameter");
    }
    if ($post_content == "") {
        $_SESSION["ErrorMessage"] = "This Field can't be Empty";
        Redirect_to("editpost.php?id=$searchParameter");
    }
    if (strlen($post_content) > 1000000) {
        $_SESSION["ErrorMessage"] = "Content too Long";
        Redirect_to("editpost.php?id=$searchParameter");
    }
    if (!empty($_FILES["post_image"]["name"])) {
            
        move_uploaded_file($post_image_tmp,"../images/$post_image");
        $update_post = "UPDATE post SET post_title = ?, category = ?, post_image = ?, post_author = ?, post_keyword = ?, post_content = ? WHERE post_id = '$searchParameter'";
        if($stmt = mysqli_prepare($connect, $update_post)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $param_title, $param_category, $param_image, $param_author, $param_keyword, $param_content);

         $param_title = $post_title;
         $param_category = $cat;
         $param_image = $post_image;
         $param_author = $post_author;
         $param_keyword = $post_keyword;
         $param_content = $post_content;
        
            }

        } else {
    
        $update_post = "UPDATE post SET post_title = ?, category = ?, post_author = ?, post_keyword = ?, post_content = ? WHERE post_id = '$searchParameter'";
        if($stmt = mysqli_prepare($connect, $update_post)) {
        mysqli_stmt_bind_param($stmt, "sssss", $param_title, $param_category, $param_author, $param_keyword, $param_content);

         $param_title = $post_title;
         $param_category = $cat;
         $param_author = $post_author;
         $param_keyword = $post_keyword;
         $param_content = $post_content;

            }

        }

        
        
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["SuccessMessage"] = "Post Updated Successfully.";
            Redirect_to("../posts.php");
            exit();
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Please try again later.";
            Redirect_to("editpost.php?id=$searchParameter");
        }

            mysqli_stmt_close($stmt);

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
<link rel = "stylesheet" href = "styles.css">
    <title> Edit Posts </title>
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
                        <a href  = "../posts.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Posts </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "categories.php" class = "nav-link" style = "font-family:Book Antiqua;"> Categories</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "admins.php" class = "nav-link" style = "font-family:Book Antiqua;"> Manage Admins</a>
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
    <h1 style = "font-family: Broadway;"><i class = "fas fa-edit" style = "color: #27AAE1;"></i> Edit Post </h1>
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
            <?php
            $searchParameter = $_GET["id"];

            $sql_post = "SELECT * FROM post WHERE post_id= '$searchParameter'";

            $run_post = mysqli_query($connect,$sql_post);

            while($fetch_post = mysqli_fetch_array($run_post)) {
                $title = $fetch_post["post_title"];
                $category = $fetch_post["category"];
                $DateTime = $fetch_post["datetime"];
                $author = $fetch_post["post_author"];
                $keyword = $fetch_post["post_keyword"];
                $image = $fetch_post["post_image"];
                $posttext = $fetch_post["post_content"];
            }
            ?>
            <form action = "editpost.php?id=<?php echo $searchParameter; ?>" method = "post" enctype = "multipart/form-data">
                <div class = "card bg-secondary text-dark mb-3">
    <div class = "card-body bg-dark">
        <div class = "form-group mb-1">
            <label for = "title"><span class = "FieldInfo"> Post Title: </span></label>
                <input class = "form-control" type = "text" name = "post_title" id = "title" value = "<?php echo $title; ?>" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group">
            <span class = "FieldInfo">Old Category:</span>
            <span class="TextInfo"><?php echo $category; ?></span>
            <br>
            <label for = "CategoryTitle"><span class = "FieldInfo"> New Category: </span></label>
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
        <span class = "FieldInfo">Old Category:</span>
        <img class = "mb-2" src="../images/<?php echo $image; ?>" width="170px" height="100px">
            <div class = "custom-file">
                <input class = "custom-file-input" type = "file" name = "post_image" id = "imageSelect" value = "">
                    <label for = "imageSelect" class = "custom-file-label"> Select Image </label>
            </div>
        </div>
        <div class = "form-group mb-1">
            <label for = "author"><span class = "FieldInfo"> Post Author: </span></label>
                <input class = "form-control" type = "text" name = "post_author" id = "author" value = "<?php echo $author; ?>" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group mb-1">
            <label for = "keyword"><span class = "FieldInfo"> Post Keyword: </span></label>
                <input class = "form-control" type = "text" name = "post_keyword" id = "keyword" value = "<?php echo $keyword; ?>" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group mb-1">
            <label for = "content"><span class = "FieldInfo"> Post Content: </span></label>
               <textarea class = "form-control" id = "content" name = "post_content" rows = "8" cols = "80"><?php echo $posttext; ?></textarea>
        </div>
            <div class = "row">
                <div class = "col-lg-6 mb-2">
                    <a href = "../posts.php" class = "btn btn-warning btn-block" style = "font-family: Century Gothic;"><i class = "fas fa-undo-alt"></i> Back to Posts </a>
                </div>

                <div class = "col-lg-6 mb-2">
                    <button type = "submit" name = "Submit" class = "btn btn-success btn-block" style = "font-family: Century Gothic;">
                        <i class = "fas fa-check"></i> Update Post
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
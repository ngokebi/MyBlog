<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php Confirm_Login(); ?>

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
echo $image;

if(isset($_POST["Submit"])) {

        $deletepost = "DELETE FROM post WHERE post_id = '$searchParameter'";

        $rundelete = mysqli_query($connect,$deletepost);

            if($rundelete == true) {
                $Target_path_To_DELETE_Image = "../images/$image";
                unlink($Target_path_To_DELETE_Image);

            $_SESSION["SuccessMessage"] = "Post has been Deleted.";
            Redirect_to("../posts.php");
            exit();
            } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Please try again later.";
            Redirect_to("deletepost.php?id=$searchParameter");
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
<link rel = "stylesheet" href = "styles.css">
    <title> Delete Posts </title>
    <script src="https://cdn.tiny.cloud/1/96mnsk10pkg2eoqov5j9uvwckxdsvqkplraribk3dkypc1fi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({selector:'textarea'});
        selector : "textarea:not(.mceNoEditor)",
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
    <h1 style = "font-family: Broadway;"><i class = "fas fa-trash" style = "color:Crimson"></i> Delete Post </h1>
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
            <form action = "deletepost.php?id=<?php echo $searchParameter; ?>" method = "post" enctype = "multipart/form-data">
                <div class = "card bg-secondary text-dark mb-3">
    <div class = "card-body bg-dark">
        <div class = "form-group mb-1">
            <label for = "title"><span class = "FieldInfo"> Post Title: </span></label>
                <input disabled class = "form-control" type = "text" name = "post_title" id = "title" value = "<?php echo $title; ?>" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group">
            <span class = "FieldInfo">Category:</span>
            <span class="TextInfo"><?php echo $category; ?></span>
            <br>
        </div>
        <div class = "form-group">
        <span class = "FieldInfo">Image:</span>
        <img class = "mb-2" src="../images/<?php echo $image; ?>" width="170px" height="100px">
        </div>
        <div class = "form-group mb-1">
            <label for = "author"><span class = "FieldInfo"> Post Author: </span></label>
                <input disabled class = "form-control" type = "text" name = "post_author" id = "author" value = "<?php echo $author; ?>" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group mb-1">
            <label for = "keyword"><span class = "FieldInfo"> Post Keyword: </span></label>
                <input disabled class = "form-control" type = "text" name = "post_keyword" id = "keyword" value = "<?php echo $keyword; ?>" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group mb-1">
            <label for = "content"><span class = "FieldInfo"> Post Content: </span></label>
               <textarea disabled class = "form-control" id = "content" name = "post_content" rows = "8" cols = "80"><?php echo strip_tags($posttext); ?></textarea>
        </div>
            <div class = "row">
                <div class = "col-lg-6 mb-2">
                    <a href = "../posts.php" class = "btn btn-warning btn-block" style = "font-family: Century Gothic;"><i class = "fas fa-undo-alt"></i> Back to Posts </a>
                </div>

                <div class = "col-lg-6 mb-2">
                    <button type = "submit" name = "Submit" class = "btn btn-danger btn-block" style = "font-family: Century Gothic;">
                        <i class = "fas fa-trash"></i> Delete
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
<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>
<?php 

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];

Confirm_Login(); ?>

<?php

$AdminID = $_SESSION["User_ID"];

$admin = "SELECT * FROM admin WHERE admin_id = '$AdminID'";

$run = mysqli_query($connect, $admin);

while ($admin_show = mysqli_fetch_array($run)){

     $name = $admin_show["admin_name"];
     $aheadline = $admin_show["admin_headline"];
     $abio = $admin_show["admin_bio"];
     $aimage = $admin_show["admin_image"];
     $ausername = $admin_show["username"];

    }

if(isset($_POST["Submit"])) {
    
    $admin_name = $_POST["admin_name"];
    $admin_headline = $_POST["admin_headline"];
    $admin_bio = $_POST[strip_tags("admin_bio")];
    $admin_image = $_FILES["admin_image"]["name"];
    $admin_image_tmp = $_FILES["admin_image"]["tmp_name"];
    #$target = "Uploads/".basement($_FILES["image"]["name"]);

    if ($admin_name == "") {
        $_SESSION["ErrorMessage"] = "Name can't be Empty";
        Redirect_to("myprofile.php");
    }
    if ($admin_headline == "") {
        $_SESSION["ErrorMessage"] = "Headline can't be empty";
        Redirect_to("myprofile.php");
    }
    if (strlen($admin_headline) > 100) {
        $_SESSION["ErrorMessage"] = "Headline should be less than 12 characters";
        Redirect_to("myprofile.php");
    }
    if (strlen($admin_bio) > 1000) {
        $_SESSION["ErrorMessage"] = "Bio too Long";
        Redirect_to("myprofile.php");
    } 

    if (!empty($_FILES["admin_image"]["name"])) {
        move_uploaded_file($admin_image_tmp,"images/$admin_image");
        $update_admin = "UPDATE admin SET admin_name = ?, admin_headline = ?, admin_bio = ?, admin_image = ? WHERE admin_id = '$AdminID'";
        if($stmt = mysqli_prepare($connect, $update_admin)) {
        mysqli_stmt_bind_param($stmt, "ssss", $param_aname, $param_aheadline, $param_abio, $param_aimage);

         $param_aname = $admin_name;
         $param_aheadline = $admin_headline;
         $param_abio = $admin_bio;
         $param_aimage = $admin_image;
        
            }

        } else {
    
        $update_admin = "UPDATE admin SET admin_name = ?, admin_headline = ?, admin_bio = ? WHERE admin_id = '$AdminID'";
        if($stmt = mysqli_prepare($connect, $update_admin)) {
        mysqli_stmt_bind_param($stmt, "sss", $param_aname, $param_aheadline, $param_abio);

            $param_aname = $admin_name;
            $param_aheadline = $admin_headline;
            $param_abio = $admin_bio;
        
            }
    
        }

        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["SuccessMessage"] = "Details Updated Successfully.";
            Redirect_to("myprofile.php");
            exit();
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Please try again later.";
            Redirect_to("myprofile.php");
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
<link rel = "stylesheet" href = "css/styles.css">
    <title> My Profile </title>
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
                        <a href  = "blog.php?page=1" target = "_blank" class = "nav-link" style = "font-family:Book Antiqua;" > Live BLog</a>
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
    <h1 style = "font-family: Broadway;"><i class = "fas fa-user text-success mr-2" style = "color: #27AAE1;"></i> @<?php echo $ausername; ?> </h1>
        </div>
    </div>
</div>
</header>
<br>
<!-- END HEADER --> 
<!-- Main Area -->

<section class = "container py-2 mb-4">
    <div class = "row">
        <!-- left area -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h3 class="FieldInfo"><?php echo $name; ?></h3>
                    <small style="font-family:Century Gothic; color:darkgray;"><i><?php echo $aheadline; ?></i></small>
                </div>
                <div class="card-body">
                    <img src="images/<?php echo $aimage; ?>" class="block img-fluid mb-3" alt="">
                    <div class=""> <?php echo $abio; ?> </div>
                </div>
            </div>
        </div>
        <!-- right area -->
        <div class="col-md-9" style = "min-height:400px;">
            <?php echo ErrorMessage();
                  echo SuccessMessage();
            ?>
            <form action = "myprofile.php" method = "post" enctype = "multipart/form-data">
                <div class = "card bg-secondary text-dark mb-3">
                    <div class="card-header bg-secondary text-light">
                        <h4 class="FieldInfo"> Edit Profile </h4>
                    </div>
    <div class = "card-body bg-dark">
        <div class = "form-group mb-1">
                <input class = "form-control" type = "text" name = "admin_name" id = "title" placeholder="Your name" value = "" style = "font-family: Century Gothic;">
        </div>
        <br>
        <div class = "form-group mb-1">
                <input class = "form-control" type = "text" id = "title" placeholder="Headline" name = "admin_headline" value = "" style = "font-family: Century Gothic;">
                <small class="text-muted"> Add a professional headline like, 'Engineer' at XYZ or 'Architect' </small>
                <span class="text-danger"> Not more than 100 characters </span>
        </div>
        <br>
        <div class = "form-group mb-1">
               <textarea class = "form-control" id = "content" placeholder="Bio" name = "admin_bio" rows = "8" cols = "80"></textarea>
        </div>
        <br>
        <div class = "form-group mb-1">
            <div class = "custom-file">
                <input class = "custom-file-input" type = "file" name = "admin_image" id = "imageSelect" value = "">
                    <label for = "imageSelect" class = "custom-file-label"> Select Image </label>
            </div>
        </div>
        <br>
            <div class = "row">
                <div class = "col-lg-6 mb-2">
                    <a href = "dashboard.php" class = "btn btn-warning btn-block" style = "font-family: Century Gothic;"><i class = "fas fa-undo-alt"></i> Back to Dashboard </a>
                </div>
                <div class = "col-lg-6 mb-2">
                    <button type = "submit" name = "Submit" class = "btn btn-success btn-block" style = "font-family: Century Gothic;">
                        <i class = "fas fa-check"></i> Update
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
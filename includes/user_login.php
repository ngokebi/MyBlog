<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>



<?php

if (isset($_POST["Submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $_SESSION["ErrorMessage"] = "All Fields must be filled";
        Redirect_to("user_login.php");
    } else
    {
    
        $sql_login = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($connect, $sql_login);

        while($row_login = mysqli_fetch_array($result)) {

            $user_id = $row_login["user_id"];
            $UserName = $row_login["username"];
            $user_name = $row_login["name"];
    
        if (mysqli_num_rows($result) == 1 ) {
            $_SESSION["User_ID"] = $user_id;
            $_SESSION["username"] = $username;
            $_SESSION["UserName"] = $name;
            $_SESSION["SuccessMessage"] = "Welcome ".$_SESSION["UserName"];
            if (isset($_SESSION["TrackingURL"])) {
                Redirect_to($_SESSION["TrackingURL"]);
            } else {
            Redirect_to("blog.php");
            }
        } else {
            $_SESSION["ErrorMessage"] = "User Name or Password is incorrect";
            Redirect_to("user_login.php");
        }
        mysqli_stmt_close($stmt);
        }  
    } 
    
}
?>
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

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<title> User Login </title>
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
        <h1 class="navbar-brand" style = "font-family:Century Gothic;color:darkgray;"><strong><i> User Login </i></strong></h1>  
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
                        <a href  = "blog.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Blog </a>
                    </li>
                    &nbsp;&nbsp;
                    <li class = "nav-item">
                        <a href  = "#" class = "nav-link" style = "font-family:Book Antiqua;"> Contact Us </a>
                    </li>
                    &nbsp;&nbsp;
                </ul>
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
        </div>
    </div>
</div>
</header>
<!-- END HEADER --> 
<!-- Main Area Start -->
<section class = "container py-2 mb-4">
<div class = "row">
    <div class = "offset-sm-3 col-sm-6" style = "min-height:500px;">
    <br><br><br>
    <?php 
        echo ErrorMessage();
        echo SuccessMessage();
    ?>
        <div class = "card bg-secondary text-light">
            <div class = "card-header">
                <h4 style = "font-size:30px; font-family:Broadway; color:HoneyDew;"><strong><i> Login </i></strong></h4>
            </div>
                <div class = "card-body bg-dark">
                <form action = "user_login.php" method = "post">
                    <div class = "form-group">
                        <label for = "username"> <span class = "FieldInfo"> Username: </span></label>
                        <div class = "input-group mb-3">
                            <div class = "input-group-prepend">
                                <span class = "input-group-text text-gery"><i class = "fas fa-user"></i></span>
                            </div>
                            <input type = "text" class = "form-control" name = "username" id = "username" value = "">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "password"> <span class = "FieldInfo"> Password: </span></label>
                        <div class = "input-group mb-3">
                            <div class = "input-group-prepend">
                                <span class = "input-group-text text-gery"><i class = "fas fa-lock"></i></span>
                            </div>
                            <input type = "password" class = "form-control" name = "password" id = "password" value = "">
                        </div>
                    </div>
               
                    <input type = "submit" name = "Submit" class = "btn btn-info btn-block" value = "Login"><br>
                    <p style = "font-family: Colonna MT; font-size: 20px;">Don't have an account? <a href="register.php" style = "font-family: Colonna MT; font-size: 20px;">Sign up now</a>.</p>
                </form>
                </div>
        </div>
    </div>
</div>
</section>
<!-- Main Area End -->
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
<?php

$connect = mysqli_connect("localhost", "root", "", "MyBlog");

if($connect == false) {

    echo " Error in Connection." . mysqli_connect_error();

}

?>
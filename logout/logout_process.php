<?php

include_once '../_includes/config.php';

//checks if the admin cookie is set
/*
if(isset($_COOKIE['admin'])) {

    //if it is set we delete it
    setcookie("admin", "", time()-3600, "/");
}

//checks to see if the workerId is set
if(isset($_COOKIE['workerId'])) {

    //if it is we delete it
    setcookie("workerId", "", time()-3600, "/");
}

if(isset($_COOKIE['bookLoggedIn'])) {

    //if it is we delete it
    setcookie("bookLoggedIn", "", time()-3600, "/");
}

header("Location: ../#homeSection");
*/

if(isset($_SESSION["loggedInUser"])){
    unset($_SESSION["loggedInUser"]);


    header("Location: ../index.php");
}


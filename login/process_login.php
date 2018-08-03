<?php

include_once '../_includes/config.php';

//collects information from the form
$email = $_POST["email"];
$password = $_POST["password"];

//connection to the database
include '../_includes/connection.php';

//This first sql checks to see if a worker is logging in
//build sql query to retrieve data
//$sql = "SELECT * FROM user WHERE email=:email AND password=:password LIMIT 1";

$sql = "SELECT * FROM user WHERE email=:email LIMIT 1";


$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
//$pdoQuery->bindValue(":password", $password, PDO::PARAM_STR);

$pdoQuery->execute();


$row = $pdoQuery->fetch(PDO::FETCH_ASSOC);

//var_dump($row);

if(is_array($row)) {


    if(password_verify($password, $row["password"])){
        
        //echo "correct";
        $userId = $row['userId'];
        $userRole = $row["role"];

        //echo $userRole;
        $_SESSION["user_id"] = "";
        $_SESSION["user_role"] = "";


        $_SESSION["user_id"] = $userId;
        $_SESSION["user_role"] = $userRole;

        header("Location: " . URL_ROOT . "/profile/profile.php?userId=" . 
                $userId);

    } else {
        

        $_SESSION['login_message'] = "Wrong email or password";

        header("Location: " . URL_ROOT . "/login/index.php");
    }

}












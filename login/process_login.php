<?php

//collects information from the form
$email = $_POST["email"];
$password = $_POST["password"];

//connection to the database
include '../_includes/connection.php';


//build sql query to retrieve data
$sql = "SELECT * FROM worker WHERE email=:email AND password=:password LIMIT 1";


$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
$pdoQuery->bindValue(":password", $password, PDO::PARAM_STR);

$pdoQuery->execute();


$row = $pdoQuery->fetch(PDO::FETCH_ASSOC);



if(is_array($row)) {

    //set a cookie that contains the workerId
    setcookie("workerId", $row['workerId'], 0, "/");

    if ($row['admin'] === "yes") {
        //echo "is an admin";
        setcookie("admin", "yes", 0, "/");

        header("Location: ../admin/index.php");
    } else if ($row['admin'] === "no") {
        //echo "is not an admin";
        setcookie("admin", "no", 0, "/");

        header("Location: ../employee/index.php");
    }



} else {
    //set an error cookie
    setcookie("loginError", "Your username or password was incorrect", 0, "/");

    //redirect back to the homepage
    header("Location: ../index.php");
}










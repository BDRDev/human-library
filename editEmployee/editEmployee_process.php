<?php

include '../_includes/config.php';
include ABSOLUTE_PATH . '/_includes/connection.php';

$workerId = $_POST["workerId"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];
$adminChange = $_POST["admin"];

$sql = "UPDATE worker SET firstName=:firstName, lastName=:lastName, email=:email, password=:password, admin=:admin WHERE workerId=:workerId";

$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
$pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
$pdoQuery->bindValue(":password", $password, PDO::PARAM_STR);
$pdoQuery->bindValue(":admin", $adminChange, PDO::PARAM_STR);
$pdoQuery->bindValue(":workerId", $workerId, PDO::PARAM_INT);

//setCookie('admin', '', time()-3600, '/');

//for this to work you need to check if you're editing your self
//not too important
/*
if($admin === "no") {
    setcookie("admin", "no", 0, "/");
} else if($admin === "yes"){
    setcookie("admin", "yes", 0, "/");
}
*/

if($pdoQuery->execute()){
    setcookie("editEmployee", "Edit was successful", 0, "/");
}

if($_COOKIE["admin"] === "yes"){
    header("Location: edit.php");
} else {
    header("Location: ../employee/index.php");
}


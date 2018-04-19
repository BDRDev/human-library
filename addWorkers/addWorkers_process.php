<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

//grabs the data from the form
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$admin = $_POST['admin'];

/*
echo "First Name: " . $firstName . "<br>";
echo "Last Name: " . $lastName . "<br>";
echo "Email: " . $email . "<br>";
echo "Password: " . $password . "<br>";
echo "Admin: " . $admin . "<br>";
*/

//check to see if the email is already in the database
$checkSql = "SELECT email FROM worker";

$results = $conn->query($checkSql);

$unique = "yes";

foreach ($results as $result){

    if($result['email'] === $email) {
        $unique = "false";
    }
}

//echo $unique;

if($unique === "yes") {

    $sql = "INSERT INTO worker VALUES (NULL, :firstName, :lastName, :email, :password, :admin)";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
    $pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
    $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
    $pdoQuery->bindValue(":password", $password, PDO::PARAM_STR);
    $pdoQuery->bindValue(":admin", $admin, PDO::PARAM_STR);

    $pdoQuery->execute();

    setcookie("addEmployee", "Employee was successfully added", 0, "/");

    header("Location: ../admin/index.php");
}

//else if($unique === "false") {

    //setcookie("addEmployee", "Email has already been used", 0, "/");

    //header("Location: ../admin/index.php");
//}
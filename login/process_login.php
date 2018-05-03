<?php

//collects information from the form
$email = $_POST["email"];
$password = $_POST["password"];

//connection to the database
include '../_includes/connection.php';

//This first sql checks to see if a worker is logging in
//build sql query to retrieve data
$sql = "SELECT * FROM worker WHERE email=:email AND password=:password LIMIT 1";


$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
$pdoQuery->bindValue(":password", $password, PDO::PARAM_STR);

$pdoQuery->execute();


$row = $pdoQuery->fetch(PDO::FETCH_ASSOC);



//This is where we check to see if it is an employee trying to log in
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


    //If the search returns null we check to see if its a book
} else {
    //This is where we will check to see if it is a book trying to log in

    //This is the email and password from the login form

    //echo "Password: " . $password . "<br>";
    //echo $email . "<br>";

    //In order to check if the hashed passwords match we have to get it from the db
    $sql = "SELECT * FROM bookinfo WHERE email=:email LIMIT 1";
    $pdoQuery = $conn->prepare($sql);
    $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);

    //This checks to make sure that we get a result from the query
    //If not the user has entered the wrong password and we will redirect them back to the
    //login page

    if($pdoQuery->execute()){
        //echo "success";

        //This retrieves the row of data that we got from the db
        $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);

        //this is where we verify that the two passwords match
        if(password_verify($password, $row["password"])){
            //if they match we will take them to their profile page where they will be able to edit
            //their information

            //Here we will set a bookLoggedIn cookie
            //This cookie will contain the bookInfo id
            //When we get to the profile page we will check if the id in the url matches the
            //id from the cookie, if it does we will display user information
            //if not we will not show anything

            $displayId = $row["displayId"];

            setcookie("bookLoggedIn", $displayId, 0, "/");

            header("Location: ../book/profile.php?displayId=$displayId");

        } else {
            //Here is where we redirect the user back to the login page and set a cookie
            //giving them an error message

            echo "Something went wrong";

        }

    } else {
        //This is where we will handle a user putting in the wrong email
        //re rout the user back to the login page


        echo "Fuck";
        //set an error cookie
        //setcookie("loginError", "Your username or password was incorrect", 0, "/");

        //redirect back to the homepage
        //header("Location: ../index.php");
    };




}










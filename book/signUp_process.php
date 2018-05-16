<?php
include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';
//this is where I will salt the password given and add that to the database

$email = $_POST["email"];
$password = $_POST["password"];
$passwordHash = "";

//echo "Password: " . $password . "<br>";
//echo "Email: " . $email . "<br>";


$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//echo "Password Hash: " . $passwordHash . "<br><br>";

$passwordMatch = password_verify($password, $passwordHash);

if($passwordMatch === TRUE) {

    //echo "The Same";


    $sql = "UPDATE bookinfo 
            SET password = '$passwordHash', setPass = NULL 
            WHERE email = '$email'";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":password", $passwordHash, PDO::PARAM_STR);



    if($pdoQuery->execute()){
        //echo "success";

        $sql = "SELECT * FROM bookinfo WHERE email=:email";

        $pdoQuery = $conn->prepare($sql);

        $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);

        if($pdoQuery->execute()){

            $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);


            //var_dump($row);

            //.setcookie("bookLoggedIn", $row["displayId"], 0, "/");

            $_SESSION["bookLoggedIn"] = $row["displayId"];

            $displayId = $row["displayId"];

            //echo "DisplayId: " . $displayId;
            //here is where we know that it is a valid user, all his credentials are in order, and he is logged in
            //This shouldnt usually be a problem but we will go ahead and log out other people just for the sake of being careful

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
            */

            if(isset($_SESSION["loggedInUser"])){
                unset($_SESSION["loggedInUser"]);

                $_SESSION["loggedInUser"] = "book";
            }


            header("Location: " . URL_ROOT . "/book/profile.php?displayId=" . $displayId);

            //header("Location: " . URL_ROOT . "/signUp/index.php");

        } else {
            echo "Problem";
        };


    };


}
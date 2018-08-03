<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/cookies/cookies.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];

$setPass = "";


//first thing we need to do is check to see if the email is in the database
$uniqueEmail = TRUE;

$sql = "SELECT email FROM user";
$pdoQuery = $conn->prepare($sql);

$pdoQuery->execute();

$emails = $pdoQuery->fetchAll();

//If the email is not unique do not add the stuff to the db and send them back
//to the form with a cookie that tells them

foreach($emails as $singleEmail){

    if($singleEmail["email"] === $email){
        $uniqueEmail = FALSE;

        break;

    }
}

if($uniqueEmail === TRUE) {

    function random_password($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@%";
        $setPass = substr(str_shuffle($chars), 0, $length);
        return $setPass;
    }


    $setPass = random_password(8);


    $profileLink = "<a href='" . URL_ROOT . "/profile/set_password.php?setPass=" . $setPass . "'>Set a Password<a/>";

//SendTo will be the email that the user provided

//Need to edit the the

    $sendTo = "blaker1136@gmail.com";

    $subject = "To " . $firstName . " " . $lastName;

    $message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<div>" . $profileLink . "</div>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>" . $firstName . "</td>
<td>" . $lastName . "</td>
</tr>
</table>
</body>
</html>
";


    $headers .= "Reply-To: The Sender <sender@domain.com>\r\n";
    $headers .= "Return-Path: The Sender <sender@domain.com>\r\n";
    $headers .= "From: The Sender <sender@domain.com>\r\n";
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if(mail($sendTo, $subject, $message, $headers)){


        $sql = "INSERT INTO user (firstName, lastName, email, userId, setPass) 
        VALUES(:firstName, :lastName, :email, NULL, :setPass)";

        $pdoQuery = $conn->prepare($sql);

        $pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
        $pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
        $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
        $pdoQuery->bindValue(":setPass", $setPass, PDO::PARAM_STR);


        //This will run if the user has selected a unique id and the message was
        //successfully sent
        if ($pdoQuery->execute()) {

            $_SESSION["sign_up_message"] = "Sign up was successful, you will be receiving an email shortly";

            header("Location: " . URL_ROOT . "/signUp/index.php");

        };

    } else {
        echo "shit";

        //here is where I would put the error system

        //My thought foe now is I would have apage that just I can see that will have a list of errors, what page they were on, time, number of them, ect.

        //could be a cool little thing to add.
    };


} else {


    //echo "un unique";
    //this runs id the email has already been used, this just lets the user know they need to pick
    //a new email to use
    if(!isset($_SESSION["sign_up_message"])) {
        $_SESSION["sign_up_message"] = "That email has already been used, please pick another one";
    }

    header("Location: " . URL_ROOT . "/signUp/index.php");
}





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

$sql = "SELECT email FROM bookinfo";
$pdoQuery = $conn->prepare($sql);

$pdoQuery->execute();

$emails = $pdoQuery->fetchAll();

//If the email is not unique do not add the stuff to the db and send them back
//to the form with a cookie that tells them

foreach($emails as $singleEmail){

    if($singleEmail["email"] === $email){
        $uniqueEmail = FALSE;

    }
}

if($uniqueEmail === TRUE) {

    function random_password($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@%";
        $setPass = substr(str_shuffle($chars), 0, $length);
        return $setPass;
    }


    $setPass = random_password(8);


    $profileLink = "<a href='" . URL_ROOT . "/book/signUp.php?setPass=" . $setPass . "'>Set a Password<a/>";

//SendTo will be the email that the user provided

//Need to edit the the

    $sendTo = "humanlibraryiu@gmail.com";

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


        $sql = "INSERT INTO bookinfo (firstName, lastName, email, displayId, setPass) 
        VALUES(:firstName, :lastName, :email, NULL, :setPass)";

        $pdoQuery = $conn->prepare($sql);

        $pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
        $pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
        $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
        $pdoQuery->bindValue(":setPass", $setPass, PDO::PARAM_STR);


        if ($pdoQuery->execute()) {
            header("Location: " . URL_ROOT . "/signUp/index.php");

        };

    } else {
        echo "shit";
    };


} else {



    //this runs id the email has already been used, this just lets the user know they need to pick
    //a new email to use
    if(!isset($_SESSION["bookSignUpMessage"])) {
        $_SESSION["bookSignUpMessage"] = "This is a session var";
    }

    header("Location: " . URL_ROOT . "/signUp/index.php");
}





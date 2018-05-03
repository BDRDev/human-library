<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];

echo "First Name: " . $firstName . "<br>";
echo "Last Name: " . $lastName . "<br>";
echo "Email: " . $email . "<br><br>";


$setPass = random_password(8);


function random_password($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@$%";
    $setPass = substr( str_shuffle( $chars ), 0, $length );
    return $setPass;
}

echo "Default Pass: " . $setPass . "<br><br>";





//mail("blaker1136@gmail.com", "idk", "this is the message");

//Need to check if the email is already in the db
//Check if the email is in the

/* =================================================================================
This is a page that you would not see this is here because we cannot use the email function
This would re rout back to the sign up page
====================================================================================*/

$sql = "INSERT INTO bookinfo (firstName, lastName, email, displayId, setPass) 
        VALUES(:firstName, :lastName, :email, NULL, :setPass)";

$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
$pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
$pdoQuery->bindValue(":setPass", $setPass, PDO::PARAM_STR);

if($pdoQuery->execute()){
    echo "success" . "<br>";

    echo "Wouldnt usually see this page, but I dont have the email set up yet <br>";

    echo "THIS IS THE LINK THAT WOULD BE IN THE EMAIL <br>";

    echo "<a href='" . URL_ROOT . "/book/signUp.php?setPass=" . $setPass . "'>Click Here<a/>";
};




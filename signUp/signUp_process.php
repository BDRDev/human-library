<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];

echo "First Name: " . $firstName . "<br>";
echo "Last Name: " . $lastName . "<br>";
echo "Email: " . $email . "<br><br>";


$defaultPass = random_password(8);


function random_password($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&";
    $defaultPass = substr( str_shuffle( $chars ), 0, $length );
    return $defaultPass;
}

echo "Default Pass: " . $defaultPass . "<br><br>";

//this is where we will encrypt the random password

$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_RANDOM),
];

$passwordHash = password_hash($defaultPass, PASSWORD_BCRYPT, $options);

echo "Password Hash: " . $passwordHash . "<br><br>";

$passwordMatch = password_verify($defaultPass, $passwordHash);

var_dump($passwordMatch);

echo "Password Match: " . $passwordMatch;



mail("blaker1136@gmail.com", "idk", "this is the message");


$sql = "INSERT INTO bookinfo (firstName, lastName, email, displayId) 
        VALUES(:firstName, :lastName, :email, NULL)";

$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
$pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);

//$pdoQuery->execute();



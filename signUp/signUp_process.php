<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];

echo $firstName . " " . $lastName . " " . $email;
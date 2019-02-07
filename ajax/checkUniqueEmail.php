<?php

$email = $_GET['email'];

include_once "../classes/user.class.php";

$user = new User();

echo json_encode($user->uniqueEmail($email));
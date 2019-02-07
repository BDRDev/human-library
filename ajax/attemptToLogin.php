<?php

include '../_includes/config.php';


$email = $_GET['email'];
$password = $_GET['password'];

echo json_encode($user->attemptLogin($email, $password));

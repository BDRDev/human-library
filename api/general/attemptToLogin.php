<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/user.class.php';

$user = new User();

$email = $_GET['email'];
$password = $_GET['password'];

echo json_encode($user->attemptLogin($email, $password));

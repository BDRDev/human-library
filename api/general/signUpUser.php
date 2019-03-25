<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$user = new User();

echo json_encode($user->signUpUser($first, $last, $email, $password, $role));
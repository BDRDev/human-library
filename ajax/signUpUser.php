<?php

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// $first = $_GET['first'];
// $last = $_GET['last'];
// $email = $_GET['email'];
// $password = $_GET['password'];


include_once "../classes/user.class.php";

$user = new User();

echo json_encode($user->signUpUser($first, $last, $email, $password, $role));
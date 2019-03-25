<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/user.class.php';

$email = $_GET['email'];

$user = new User();

echo json_encode($user->uniqueEmail($email));
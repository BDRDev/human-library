<?php

function generateEmail($first, $last, $role, $email){
	$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<div>
		" . $first . " " . $last . " has updated their profile and would like their " . $role . " account to be reviewed
		</div>
		Email: " . $email . "
		</body>
		</html>
		";

	return $message;
}
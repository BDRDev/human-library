<?php

function generateEmail($first, $last, $role, $email){

$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
	<div>
	" . $first . " " . $last . " Created a " . $role . " account!
	<br>
	Email: " . $email . "
	</div>
	
	</body>
	</html>
	";

	return $message;
}
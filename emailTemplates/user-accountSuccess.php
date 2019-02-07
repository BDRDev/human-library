<?php


//function will generate the email body
function generateEmail($role){

	$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<div>
		Thank you for registering to participate in the 2019 IUPUI Human Library as a " . $role . "!  We are reviewing your application and will be contacting you shortly.
		<br><br>

		Many thanks,<br>
		The IUPUI Human Library Team
		</div>
		
		</body>
		</html>
		";

	return $message;
}
<?php

function generateEmail(){

	 $message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<div>
		Thank you for registering to participate as a librarian for the 2019 IUPUI Human Library. We are happy to inform you that we have approved your application and we invite you to log into your profile through <a href='http://www.humanlibrary.us/login/index.php'>Here</a> you can list the times you are available for the day of the event. 
		<br><br>

		Emails regarding information sessions and trainings will be sent out shortly.  Should you have any questions, comments, concerns please feel free to email HLIUPUI@iupui.edu
		<br><br>


		Thank you,
		<br>
		The IUPUI Human Library Team
		</div>
		
		</body>
		</html>
		";

	return $message;
}
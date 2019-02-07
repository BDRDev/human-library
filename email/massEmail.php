

<?php

	

	if($_POST){

		include_once '../_includes/config.php';

		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];

	    //$sendTo = $email

	    //$subject = "This is a huge test pls work pls";

	    $message = "
				<html>
				<head>
				<title>HTML email</title>
				</head>
				<body>
				<div>
				" . $content . "
				</div>
				
				</body>
				</html>
				";


	    $headers .= "Reply-To: The Sender <sender@domain.com>\r\n";
	    $headers .= "Return-Path: The Sender <sender@domain.com>\r\n";
	    $headers .= "From: The Sender <sender@domain.com>\r\n";
	    $headers .= "Organization: Sender Organization\r\n";
	    $headers .= "X-Priority: 3\r\n";
	    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
	    $headers .= "MIME-Version: 1.0\r\n";
	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	    mail($email, $subject, $message, $headers);

	} else {
		echo "idk";
	}
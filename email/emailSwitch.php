<?php

include_once('./phpmailer.php');

$emailType = $_POST['emailType'];
$email = $_POST['email'];


switch($emailType){

	case 'userSignUpSuccess':

		$role = $_POST['role'];

		include_once('../emailTemplates/user-accountSuccess.php');
		$body = generateEmail($role);
		sendEmail($email, $body);
		break;

	case 'adminNewUserSignUp':

		$first = $_POST['first'];
		$last = $_POST['last'];
		$userEmail = $_POST['userEmail'];
		$role = $_POST['role'];

		include_once('../emailTemplates/admin-newUser.php');
		$body = generateEmail($first, $last, $role, $userEmail);
		sendEmail($email, $body);
		break;

	case 'adminUnverifiedNotice':

		$first = $_POST['first'];
		$last = $_POST['last'];
		$userEmail = $_POST['userEmail'];
		$role = $_POST['role'];

		include_once('../emailTemplates/admin-unverifiedNotice.php');
		$body = generateEmail($first, $last, $role, $userEmail);
		sendEmail($email, $body);
		break;

	case 'bookAccountApproved': 

		include_once('../emailTemplates/book-accountApproved.php');
		$body = generateEmail();
		sendEmail($email, $body);
		break;

	case 'librarianAccountApproved':

		include_once('../emailTemplates/librarian-accountApproved.php');
		$body = generateEmail();
		sendEmail($email, $body);
		break;		

}

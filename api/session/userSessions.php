<?php




include_once('../../_includes/config.php');

$action;
$session_name;
$value;


if($_POST){
	$action = $_POST['action'];
	$session_name = $_POST['session'];
	$value = $_POST['value'];
}

if($_GET){
	$action = $_GET['action'];
	$session_name = $_GET['session'];
}



switch($action){

	case "set": 

		$session->create_session($session_name, $value);
		break;

	case "retrieve": 

		echo $session->get_session($session_name);
		break;

	case "destroy":

		$session->remove_session($session_name);
		break;
}

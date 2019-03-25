<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/admin.class.php';

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$userId = $_REQUEST['userId'];

	//This function adds a new event
	echo json_encode($admin->approveUser($userId));
	
}
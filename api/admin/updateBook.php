<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/admin.class.php';

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$dataArray = $_REQUEST['dataArray'];
$userId = $_POST['userId'];

//This function updates the bookDisplay table 
echo json_encode($admin->updateBookDisplay($dataArray, $userId));

//I will use other functions if I need to update anythign else for the user
//I am only going to use the above function for bookDisplay table
	
}
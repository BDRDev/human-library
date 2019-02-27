<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/admin.class.php';

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$userId = $_POST['userId'];
$eventId= $_POST['eventId'];

//This function adds the user to the attending event table 
echo json_encode($admin->addBookAttending($userId, $eventId));

	
}
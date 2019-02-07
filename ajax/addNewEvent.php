<?php

	
	

// $name = $_POST['eventName'];
// $address = $_POST['address'];
// $city = $_POST['city'];
// $state = $_POST['state'];
// $room = $_POST['room'];
// $date = $_POST['date'];
// $startTime = $_POST['startTime'];
// $endTime = $_POST['endTime'];

$name = $_GET['eventName'];
$address = $_GET['address'];
$city = $_GET['city'];
$state = $_GET['state'];
$room = $_GET['room'];
$date = $_GET['date'];
$startTime = $_GET['startTime'];
$endTime = $_GET['endTime'];

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->addNewEvent($name, $date, $startTime, $endTime, $address, $city, $state, $room));

	    

<?php

$userId = $_GET['userId'];
$eventId = $_GET['eventId'];

echo $userId;
echo $eventId;

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->addToAttending($userId, $eventId));
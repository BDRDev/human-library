<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$userId = $_GET['userId'];
$eventId = $_GET['eventId'];

$book = new Book();

echo json_encode($book->checkIfAttending($userId, $eventId));
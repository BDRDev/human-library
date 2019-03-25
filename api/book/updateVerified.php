<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$dataArray = $_REQUEST['dataArray'];
$userId = $_POST['userId'];

$book = new Book();

echo json_encode($book->updateVerifiedBook($dataArray, $userId));
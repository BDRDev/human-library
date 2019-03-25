<?php


include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$displayId = $_GET['displayId'];

$book = new Book();

echo json_encode($book->getBookData($displayId));

<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$userId = $_GET["userId"];
$why_book = $_GET["why_book"];
$book_overview = $_GET["book_overview"];

$book = new Book();

echo json_encode($book->updateUnverifiedUser($userId, $why_book, $book_overview));
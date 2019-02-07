<?php

$userId = $_GET["userId"];
$why_book = $_GET["why_book"];
$book_overview = $_GET["book_overview"];



include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->updateUnverifiedUser($userId, $why_book, $book_overview));
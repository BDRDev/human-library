<?php

$bookId = $_GET["bookId"];

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->returnBook($bookId));
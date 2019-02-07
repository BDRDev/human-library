<?php

$bookId = $_GET["bookId"];
$timeBack = $_GET["timeBack"];

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->rentBook($bookId, $timeBack));
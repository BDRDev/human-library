<?php

$displayId = $_POST['displayId'];

echo $displayId;

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->createEmptyBook($displayId));
<?php

$userId = $_GET["userId"];

//echo $userId;


include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->getUserData($userId));
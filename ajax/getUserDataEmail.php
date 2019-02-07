<?php

$email = $_GET['email'];

//echo $displayId;

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->getUserDataEmail($email));
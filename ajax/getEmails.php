<?php

$role= $_GET['role'];

//echo $displayId;

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->getEmails($role));
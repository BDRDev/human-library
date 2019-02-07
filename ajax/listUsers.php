<?php

include_once "../classes/book.class.php";

$role = $_GET['role'];

$book = new Book();

echo json_encode($book->listUsers($role));
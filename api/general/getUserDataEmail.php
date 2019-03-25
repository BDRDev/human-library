<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$email = $_GET['email'];

$book = new Book();

echo json_encode($book->getUserDataEmail($email));
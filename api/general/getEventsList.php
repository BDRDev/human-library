<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/book.class.php';

$book = new Book();

echo json_encode($book->getAllEvents());
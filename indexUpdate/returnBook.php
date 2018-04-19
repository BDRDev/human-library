<?php

$displayId = (int)$_GET["displayId"];

include_once 'bookLookup.class.php';

$returnBook = new BookLookup();

echo json_encode($returnBook->returnBook($displayId));
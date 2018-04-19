<?php

$displayId = (int)$_GET["displayId"];

include_once 'bookLookup.class.php';

$rentBook = new BookLookup();

echo json_encode($rentBook->rentBook($displayId));
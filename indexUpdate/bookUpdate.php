<?php

$displayId = (int)($_GET['displayId']);


include_once 'bookLookup.class.php';

$bookSearch = new BookLookup();

$bookSearch->lookup($displayId);

echo json_encode($bookSearch->lookup($displayId));


<?php

$displayId = (int)($_GET['displayId']);
$colChange = ($_GET['colChange']);
$value = ($_GET['value']);

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->updateSingleValue($displayId, $colChange, $value));





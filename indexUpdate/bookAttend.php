<?php


$sliderId = (int)($_GET['sliderId']);

echo $sliderId;

include_once 'bookLookup.class.php';

$bookSearch = new BookLookup();

$bookSearch->bookAttendEvent($sliderId);
<?php

$bookId = (int)($_GET['bookId']);


include_once 'bookLookup.class.php';

$bookSearch = new BookLookup();

$bookSearch->alert($bookId);




/*








*/
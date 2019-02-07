
<?php

$userId = $_GET["userId"];
$start_time = $_GET["start_time"];
$end_time = $_GET["end_time"];

include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->updateVerifiedLibrarian($userId, $start_time, $end_time));
<?php

$userId = $_GET["userId"];
$title = $_GET['title'];
$description = $_GET['description'];
$chapter_one = $_GET['chapter_one'];
$chapter_two = $_GET['chapter_two'];
$chapter_three = $_GET['chapter_three'];
$start_time = $_GET['start_time'];
$end_time = $_GET['end_time'];



include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->updateVerifiedUser($userId, $title, $description, $chapter_one, $chapter_two, $chapter_three, $start_time, $end_time));
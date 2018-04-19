<?php

if(!empty($_GET['bookId'])) {
    $bookId = filter_input(INPUT_GET, "bookId", FILTER_SANITIZE_NUMBER_INT);
}

include_once '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';

$sql = "SELECT * FROM books WHERE bookId=:bookId";

$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":bookId", $bookId, PDO::PARAM_INT);
$pdoQuery->execute();
$book = $pdoQuery->fetch(PDO::FETCH_ASSOC);

$bookImage = $book["bookImage"];

$image = explode('/', $bookImage);
$toDelete = ABSOLUTE_PATH . '/assets/images/' . $image[2];

//echo $toDelete;


$sql = "DELETE FROM books WHERE bookId=:bookId";

$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":bookId", $bookId, PDO::PARAM_INT);


if($pdoQuery->execute()) {
    setcookie("editMessage", "Book was successfully deleted", 0, "/");
}

unlink($toDelete);

header("Location: index.php");

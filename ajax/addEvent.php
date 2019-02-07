<?php

$name = $_GET["name"];
$date = $_GET["date"];
$time = $_GET["time"];
$address = $_GET["address"];
$city = $_GET["city"];
$state = $_GET["state"];


include_once "../classes/book.class.php";

$book = new Book();

echo json_encode($book->addEvent($name, $date, $time, $address, $city, $state));
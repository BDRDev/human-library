<?php

//echo "welcome to the update page";

//here we will be doing two different queries
//the first is for the bookInfo table, since we know that this table is already populated we
//just need to do an update

//next we have to check again to see if the two display ids exist
//if they do we update the display table
//if they dont we insert into the display table.

include_once "../_includes/config.php";

include_once ABSOLUTE_PATH . '/_includes/connection.php';

//first update
//gets info for the bookInfo table

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];

$displayId = $_COOKIE["bookLoggedIn"];
echo $displayId;

$sql = "UPDATE bookinfo
        SET firstName=:firstName, lastName=:lastName, email=:email
        WHERE displayId=:displayId";

$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
$pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
$pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
$pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

if($pdoQuery->execute()){

    echo "success";

}


//this is the second query
//either inserts or updates bookDisplay table

//get info from table
$title = $_POST["title"];
$chapters = $_POST["chapters"];
$time = $_POST["time"];


$sql = "SELECT * FROM bookdisplay WHERE displayId=:displayId";

$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

$pdoQuery->execute();

if($row = $pdoQuery->fetch(PDO::FETCH_ASSOC)){
    //if the query returns a row
    //here is where we update

    $sql = "UPDATE bookdisplay
            SET title=:title, chapters=:chapters, time=:time
            WHERE displayId=:displayId";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":title", $title, PDO::PARAM_STR);
    $pdoQuery->bindValue(":chapters", $chapters, PDO::PARAM_STR);
    $pdoQuery->bindValue(":time", $time, PDO::PARAM_STR);
    $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

    if($pdoQuery->execute()){
        header("Location: profile.php?displayId=$displayId");
    };




}else {
    //if the query doesnt return anything
    //here is where we insert

    $sql = "INSERT INTO bookdisplay (displayId, title, chapters, time)
            VALUES(:displayId, :title, :chapters, :time)";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);
    $pdoQuery->bindValue(":title", $title, PDO::PARAM_STR);
    $pdoQuery->bindValue(":chapters", $chapters, PDO::PARAM_STR);
    $pdoQuery->bindValue(":time", $time, PDO::PARAM_STR);

    if($pdoQuery->execute()){
        header("Location: profile.php?displayId=$displayId");
    }



};

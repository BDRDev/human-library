<?php

//ini_set('display_errors',1);
//error_reporting(E_ALL);

$bookId = $_GET["bookId"];

include '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';

include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

include_once ABSOLUTE_PATH . "/_includes/main_nav.inc.php";

$sql = "SELECT * FROM books WHERE bookId=:bookId LIMIT 1";
$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":bookId", $bookId, PDO::PARAM_INT);
$pdoQuery->execute();
$row = $pdoQuery->fetch(PDO::FETCH_ASSOC);
?>

<div class="details">

    <?php
    //everything goes in here

    $bookImage = "assets/images/whiteLogo.ico";
    if($book["bookImage"] != "assets/images/") {
        $bookImage = $book["bookImage"];
    }

    echo "<div class='details_content'>";
    echo "<span class='book_Image'> <img src='".$bookImage."' /> </span> <br>";
    echo "<h3 class='first_Name'>" . $row["title"] . "</h3>" . "<br>";
    echo "<div class='s_tory'>" . $row["story"] . "</div>" . "<br>";
    echo "<span class='chapters'>" . $row['chapters'] . "</span>";
    echo "</div>";

    //$chapters = json_decode($row["chapters"]);
    //var_dump($chapters);
    //echo "<br>";
    //
    //foreach($chapters as $chapter){
    //    var_dump($ch = $chapter[0]);
    //        echo $ch;
    //    var_dump($ch = $chapter[1]);
    //    var_dump($ch = $chapter[2]);
    //    //echo $ch . "<br>";
    //}
    ?>

</div>
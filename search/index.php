<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

include '_includes/config.php';
include '_includes/connection.php';

include_once '_includes/header.inc.php';

include_once '_includes/main_nav.inc.php';

//sql to get all of the books
$sql = "SELECT * FROM books";

//stores the books in a variable
try {
    $books = $conn->query($sql);
} finally {
    echo "Nu uh";
}

//using this for the book image right now, change back to
//$book["bookImage"]
//when the images are uploaded

$bookImage = "assets/images/whiteLogo.ico"

?>


<div id="bookSection" class="book">
    <?php
    echo "<div>";
            echo "<h2 class='bookHeader'><span class='listOf'>List of</span> Books</h2>";
    echo "</div>";
    foreach ($books as $book) {

        echo "<div class='books' id='" . $book["bookId"] . "'>";

        //echo $book["bookImage"];


        echo "<div class='bookImage'>";
        echo "<a href='" . URL_ROOT . "/details/index.php?bookId=" . $book["bookId"] . "'><img src='" . $bookImage . "'></a>";
        echo "</div>";


        echo "<div class='bookContent'>";
        echo "<span class='storyTitle'>" . $book["title"] . "</span>";
        //echo "<span class='name'>by " . $book["firstName"] . " " . $book["lastName"] . "</span>";
        echo "<div class='avaHolder' style='padding: 50px 0;'>";
        echo "<div class='bookAva'>" . "Available: " . $book["available"] . "</div>";

        if ($book["timeBack"] !== NULL) {
            echo "<div class='bookAva time'>Time Back: " . $book["timeBack"] . "</div>";
        } else {
            echo "<div class='bookAva time'></div>";
        }
        echo "</div>";

        echo "</div>";

        echo "</div>";
    }
    ?>
</div>

<!--<div id="homeSection" class="home">-->
<!--    <h1>THIS WOULD BE THE POSSIBLE BANNER DIALOG...</h1>-->
<!--</div>-->

<div id="aboutSection" class="about">
    <h1>THIS WOULD TALK ABOUT THE PROJECT</h1>
</div>

<div id="contactSection" class="contact">
    <a target="_blank" href="https://soic.iupui.edu/">IUPUI SCHOOL OF INFORMATICS & COMPUTING</a>

    <a href="https://facebook.com/iupuihumanlibrary" target="_blank">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
   <path id="facebook" fill="#000000" d="M17.252,11.106V8.65c0-0.922,0.611-1.138,1.041-1.138h2.643V3.459l-3.639-0.015
	c-4.041,0-4.961,3.023-4.961,4.961v2.701H10v4.178h2.336v11.823h4.916V15.284h3.316l0.428-4.178H17.252z"></path>
  </svg>

    </a>
</div>


<?php
    include_once ABSOLUTE_PATH . '/_includes/footer.inc.php';
?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/app.js"></script>
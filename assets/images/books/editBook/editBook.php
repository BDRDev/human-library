<?php
//checks to see if the user that is logged in is an admin
//if the user is an admin it loads all the admin content
//if the user is not an admin it shows a blank page
if ($_COOKIE['admin'] === "yes") {

    include_once '../_includes/config.php';
    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

//checks to see if the workerId cookie is set
    if (isset($_COOKIE['workerId'])) {

        //sets the workerId cookie to the workerId variable
        $workerId = $_COOKIE['workerId'];

        //loads in the users data from the database based off of the workerId
        include_once ABSOLUTE_PATH . '/_includes/connection.php';
        $sql = "SELECT * FROM worker WHERE workerId=:workerId LIMIT 1";
        $pdoQuery = $conn->prepare($sql);
        $pdoQuery->bindValue(":workerId", $workerId, PDO::PARAM_INT);
        $pdoQuery->execute();
        $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);
    }

//displays the nav bar
    include_once ABSOLUTE_PATH . "/_includes/main_nav.inc.php";

    echo "<h2 class='bookName'>" . "<span class='welcome'>" . "Edit " . "</span>" . "Book" . "</h2>";
}

?>

<?php

if(!empty($_GET['bookId'])) {
    $bookId = filter_input(INPUT_GET, "bookId", FILTER_SANITIZE_NUMBER_INT);
}

$sql = "SELECT * FROM books WHERE bookId=:bookId LIMIT 1";
$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":bookId", $bookId, PDO::PARAM_INT);
$pdoQuery->execute();
$book = $pdoQuery->fetch(PDO::FETCH_ASSOC);

echo "<br><br>";

$bookPath = $book["bookImage"];
$bookStrings = explode("/", $bookPath);
$bookImage = $bookStrings[2];

?>

<form class="editBook" method="post" enctype="multipart/form-data" action="<?= URL_ROOT ?>/editBook/editBook_process.php" >

    <img src='../<?=$book["bookImage"] ?>'/>

    <input type="hidden" name="bookId" value="<?= $book["bookId"] ?>" required /> <br>

    <label for="title_edit" class="">First Name</label>
    <input type="text" name="title" id="title_edit" value="<?= $book["title"] ?>" required><br>

    <label for="story_edit" class="">Story</label>
    <input type="text" name="story" id="story_edit" value="<?= $book["story"] ?>" required>

    <label for="chapters_edit" class="">Chapters</label>
    <div id="editor" name="editor"></div>
    <input type="hidden" name="chapters" />

    <input type="hidden" name="available" value="<?= $book["available"] ?>" required><br>

    <label for="image_edit" class="">Book Image: </label> <?= $bookImage ?>
    <input type="hidden" name="bookImage" id="image_edit" value="<?= $book["bookImage"] ?>" required><br>

    <label for="newImage">New Image:</label>
    <input style="color: black;" type="file" name="newImage" id="newImage" />

    <input type="hidden" name="timeBack" value="<?= $book["timeBack"] ?>" required>

    <input type="hidden" name="alert" value="<?= $book["alert"] ?>" required><br>

    <input class="submit" type="submit" value="submit">
</form>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });

  var form = document.querySelector('.editBook');
  form.onsubmit = function() {
    // Populate hidden form on submit
    var about = document.querySelector('input[name=chapters]');
    about.value = quill.root.innerHTML;
  };
</script>

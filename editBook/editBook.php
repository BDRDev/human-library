<?php
//checks to see if the user that is logged in is an admin
//if the user is an admin it loads all the admin content
//if the user is not an admin it shows a blank page
include_once '../_includes/config.php';

if ($_SESSION["loggedInUser"] === "admin") {


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

if(!empty($_GET['displayId'])) {
    $displayId = filter_input(INPUT_GET, "displayId", FILTER_SANITIZE_NUMBER_INT);
}

$sql = "SELECT * 
        FROM bookdisplay bd
        INNER JOIN bookinfo bi
        ON bd.displayId = bi.displayId
        WHERE bd.displayId=:displayId";
$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);
$pdoQuery->execute();
$book = $pdoQuery->fetch(PDO::FETCH_ASSOC);

echo "<br><br>";



?>

<form class="editBook" method="post" enctype="multipart/form-data" action="<?= URL_ROOT ?>/editBook/editBook_process.php" >


    <input type="hidden" name="bookId" value="<?= $book["displayId"] ?>" required /> <br>

    <label for="title_edit" class="">Title</label>
    <input type="text" name="title" id="title_edit" value="<?= $book["title"] ?>" required><br>

    <!--
    <label for="story_edit" class="">Story</label>
    <textarea name="story" id="story_edit" rows="5"><?= $book["story"] ?></textarea>
    -->

    <label for="chapters_edit" class="">Chapters</label>
    <div id="editor" name="editor"><?php echo $book["chapters"]; ?></div>
    <input type="hidden" name="chapters" />


    <?php
    if ($book["available"] === "yes") {
    ?>
    <label for="#">Available</label>
    <div class="admin-decision">
        <input style="vertical-align: middle; margin: 0;" type="radio" name="available" value="yes" id="yes" checked>
        <label for="yes">Yes</label>
    </div>

    <div class="admin-decision">
        <input style="vertical-align: middle; margin: 0;" type="radio" name="available" value="no" id="no">
        <label for="no">No</label>
    </div>
    <?php

    } else if ($book["available"] === "no") {
        ?>
        <label for="#">Available</label>
        <div class="admin-decision">
            <input style="vertical-align: middle; margin: 0;" type="radio" name="available" value="yes" id="yes">
            <label for="yes">Yes</label>
        </div>

        <div class="admin-decision">
            <input style="vertical-align: middle; margin: 0;" type="radio" name="available" value="no" id="no" checked>
            <label for="no">No</label>
        </div>
        <?php
    }
    ?>


    <input type="hidden" name="timeBack" value="<?= $book["timeBack"] ?>" required>


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

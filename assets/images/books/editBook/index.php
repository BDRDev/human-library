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

    echo "<h2 class='bookName'>" . "<span class='welcome'>" . "Edit " . "</span>" . "Books" . "</h2>";
}

?>


<?php

$sql = "SELECT * FROM books ORDER BY available DESC";
$books = $conn->query($sql);



?>

<div class="editBookMessage">
    <?php
        if(isset($_COOKIE["imageMessage"])){
        echo $_COOKIE["imageMessage"];

        setcookie("imageMessage", "", time()-3600, "/");
        }

    if(isset($_COOKIE["editMessage"])){
        echo $_COOKIE["editMessage"];

        setcookie("editMessage", "", time()-3600, "/");
        }
    ?>
</div>

<table class="edit bookEdit">


    <tr>
        <th>Name</th>
        <th>Story</th>
        <th>Book Image</th>
    </tr>
    <?php

    foreach ($books as $book) {

        $bookPath = $book["bookImage"];
        $bookStrings = explode("/", $bookPath);
        $bookImage = $bookStrings[2];

        echo "<tr>";
        echo "<td>" . $book["title"] . "</td>";
        echo "<td>" . $book["story"] . "</td>";
        echo "<td>" . $bookImage . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editBook/editBook.php?bookId=" . $book["bookId"] . "'>Edit</a>" . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editBook/deleteBook_process.php?bookId=" . $book["bookId"] . "'>Delete</a>" . "</td>";


        echo "</tr>";
    }


    ?>
</table>


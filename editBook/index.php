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

    echo "<h2 class='bookName'>" . "<span class='welcome'>" . "Edit " . "</span>" . "Books" . "</h2>";
}

?>


<?php

$sql = "SELECT * FROM bookdisplay ORDER BY title";
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



        echo "<tr>";
        echo "<td>" . $book["title"] . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editBook/editBook.php?displayId=" . $book["displayId"] . "'>Edit</a>" . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editBook/deleteBook_process.php?displayId=" . $book["displayId"] . "'>Delete</a>" . "</td>";


        echo "</tr>";
    }


    ?>
</table>


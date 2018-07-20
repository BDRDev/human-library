<?php
//checks to see if the user that is logged in is an admin
//if the user is an admin it loads all the admin content
//if the user is not an admin it shows a blank page

include_once '../_includes/config.php';
if ($_SESSION["loggedInUser"] === "admin") {


    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

//checks to see if the workerId cookie is set
  

//displays the nav bar
    include_once ABSOLUTE_PATH . "/_includes/main_nav.inc.php";

    include_once ABSOLUTE_PATH .  '/_includes/connection.php';

?>


<?php

$sql = "SELECT * FROM bookdisplay ORDER BY title";
$books = $conn->query($sql);



?>



<table class="edit bookEdit">


    <tr>
        <th>Name</th>
        <th>Story</th>
        <th>Book Image</th>
    </tr>

    <?php}=

    foreach ($books as $book) {



        echo "<tr>";
        echo "<td>" . $book["title"] . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editBook/editBook.php?displayId=" . $book["displayId"] . "'>Edit</a>" . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editBook/deleteBook_process.php?displayId=" . $book["displayId"] . "'>Delete</a>" . "</td>";


        echo "</tr>";
    }

?>
    

</table>
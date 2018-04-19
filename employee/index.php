<?php

//checks to see if the admin cookie is set
if (isset($_COOKIE['admin'])) {

    include_once '../_includes/config.php';

    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

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

    include_once ABSOLUTE_PATH . '/_includes/main_nav.inc.php';

    echo "<h2 class='adminName'>" . "<span class='welcome'>" . "Welcome " . "</span>" . $row['firstName'] . " " . $row['lastName'] . "</h2>";

    $sql = "SELECT * FROM bookdisplay ORDER BY title";
    $books = $conn->query($sql);


    ?>

    <div class="rentBooksWrapper">
        <div class="rent-BooksWrapper">
            <?php

            foreach ($books as $book) {
                if ($book["available"] === "yes") {
                    echo "<div class='rent-BookWrapper employee-yes' id='" . $book["displayId"] . "'>";
                } else if ($book["available"] === "no") {
                    echo "<div class='rent-BookWrapper employee-no' id='" . $book["displayId"] . "'>";
                } else {
                    echo "<div class='rent-BookWrapper' id='" . $book["displayId"] . "'>";
                }


                echo "<div class='employee-bookInformation'>";
                echo "<div>";
                echo "</div>";
                echo "<div style='padding-top:10px;'>";
                echo "<strong>Title</strong>: " . $book["title"];
                echo "</div>";
                echo "<div class='indexAva' style='padding-top: 10px;'>";
                echo "<strong>Available</strong>: " . $book["available"];
                echo "</div>";

                if ($book["timeBack"] != NULL) {
                    echo "<div class='employee-TimeBack'>";
                    echo "Time Back: " . $book["timeBack"];
                    echo "</div>";
                } else {
                    echo "<div class='employee-TimeBack'>";
                    echo "<br>";
                    echo "</div>";
                }

                echo "</div>"; //ends book information

                echo "<div class='rentReturn'>";

                if ($book["available"] === "yes") {
                    echo "<div class='employee-Rent' id='" . $book["displayId"] . "' >RENT</div>";


                } else if ($book["available"] === "no") {

                    echo "<div class='employee-Return' id='" . $book["displayId"] . "'>RETURN</div>";

                }

                echo "</div>";

                echo "</div>";
            } //ends foreach

            ?>
        </div>

        <div class="rentedBooks">
            <div class="rentedRed"></div>
            <div class="rentedYellow"></div>
            <div class="rentedGreen"></div>
        </div>

    </div>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bookAlerts.js"></script>
    <?php
}




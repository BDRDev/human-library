<?php

//checks to see if the admin cookie is set

include_once '../_includes/config.php';

if ($_SESSION["loggedInUser"] === "admin" || $_SESSION["loggedInUser"] === "employee") {



    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

        //loads in the users data from the database based off of the workerId
        include_once ABSOLUTE_PATH . '/_includes/connection.php';
        $sql = "SELECT * FROM worker WHERE workerId=:workerId LIMIT 1";
        $pdoQuery = $conn->prepare($sql);
        $pdoQuery->bindValue(":workerId", $workerId, PDO::PARAM_INT);
        $pdoQuery->execute();
        $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);

    include_once ABSOLUTE_PATH . '/_includes/main_nav.inc.php';

    echo "<h2 class='adminName'>" . "<span class='welcome'>" . "Welcome " . "</span>" . $row['firstName'] . " " . $row['lastName'] . "</h2>";

    $sql = "SELECT * FROM bookdisplay ORDER BY title";
    $books = $conn->query($sql);


    ?>

    <div class="rentBooksWrapper">

        <div class="bookTableWrapper">

            <table class="rentTable">
                <tr>
                    <th class="rentTableHeader">Title</th>
                    <th class="rentTableHeader">Available</th>
                    <th class="rentTableHeader">Time Back</th>
                    <th class="rentTableHeader">Rent/Return</th>
                </tr>
            <?php

            foreach ($books as $book) {


                if ($book["available"] === "yes") {
                    echo "<tr class='tableRow rowAvail' id='" . $book["displayId"] . "'>";
                } else if ($book["available"] === "no") {
                    echo "<tr class='tableRow' id='" . $book["displayId"] . "'>";
                }


                    echo "<td class='bookTitle'>";
                        echo $book["title"];
                    echo "</td>";

                    echo "<td class='bookAvailability'>";
                        echo $book["available"];
                    echo "</td>";

                    echo "<td class='bookTimeBack'>";
                        echo $book["timeBack"];
                    echo "</td>";


                    if ($book["available"] === "yes") {
                        echo "<td class='rentTableRent' id='" . $book["displayId"] . "' >RENT</td>";


                    } else if ($book["available"] === "no") {

                        echo "<div class='employee-Return' id='" . $book["displayId"] . "'>RETURN</div>";

                    }


                echo "</tr>";


            } //ends foreach

            ?>
            </table>

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




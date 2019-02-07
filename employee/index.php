<?php



include_once '../_includes/config.php';


    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

    
    include_once ABSOLUTE_PATH . '/_includes/connection.php';
    

    include_once ABSOLUTE_PATH . '/_includes/main_nav.inc.php';

    $sql = "SELECT * FROM bookdisplay ORDER BY title";
    $books = $conn->query($sql);


    ?>

    <div class="rentBooksWrapper">

        <div class="bookTableWrapper">

            <table class="rentTable">
                <tr>
                    <th class="rentTableHeader">Title</th>
                    <th class="rentTableHeader">Available</th>
                    <th class="rentTableHeader">Rent/Return</th>
                </tr>
            <?php

            foreach ($books as $book) {


                if ($book["available"] === "yes") {
                    echo "<tr class='tableRow rowAvail' id='book_" . $book["displayId"] . "'>";
                } else if ($book["available"] === "no") {
                    echo "<tr class='tableRow rowNotAvail' id='book_" . $book["displayId"] . "'>";
                } else if($book["available"] === "away") {
                    echo "<tr class='tableRow rowAway' id='book_" . $book["displayId"] . "'>";
                }


                    echo "<td class='bookTitle'>";
                        echo $book["title"];
                    echo "</td>";

                    echo "<td class='bookAvailability'>";
                        echo $book["available"];
                    echo "</td>";


                    if ($book["available"] === "yes") {
                        echo "<td class='rentTableRent rent_" . $book["displayId"] . "' id='" . $book["displayId"] . "' >RENT</td>";


                    } else if ($book["available"] === "no") {

                         echo "<td class='rentTableReturn return_" . $book["displayId"] . "' id='" . $book["displayId"] . "' >RETURN</td>";

                    } else if($book["available"] === "away"){

                        echo "<td class='rentTableReturn'></td>";
                    }


                echo "</tr>";


            } //ends foreach

            ?>
            </table>

        </div>

        <div class="rentedBooks">
            
        </div>

    </div>

    <script> let page='rent'</script>
    <script src="../build/main.bundle.js"></script>
    <?php




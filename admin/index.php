<?php
//checks to see if the user that is logged in is an admin
//if the user is an admin it loads all the admin content
//if the user is not an admin it shows a blank page

include_once '../_includes/config.php';

if ($_SESSION['loggedInUser'] === "admin") {



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

    echo "<h2 class='adminName'>" . "<span class='welcome'>" . "Welcome " . "</span>" . $row['firstName'] . " " . $row['lastName'] . "</h2>";
    ?>

    <div class="adminMessage">
        <?php
        if (isset($_COOKIE['addEmployee'])) {

            echo $_COOKIE['addEmployee'];

            setcookie('addEmployee', "", -1);
        }

        if (isset($_COOKIE['addBook'])) {
            echo $_COOKIE['addBook'];
            setcookie("addBook", "", time() - 3600, "/");
        }

        if (isset($_COOKIE['imageMessage'])) {
            echo $_COOKIE['imageMessage'];
            setcookie("imageMessage", "", time() - 3600, "/");
        }
        ?>
    </div>

    <div class="adminSection">
        <?php


        //loads the add workers form
        include_once ABSOLUTE_PATH . '/addWorkers/addWorkers.php';

        include_once ABSOLUTE_PATH . "/addBook/addBook.php";
        ?>
    </div>

    <?php



} //ends if statement

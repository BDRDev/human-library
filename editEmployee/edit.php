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

    echo "<h2 class='workerName'>" . "<span class='welcome'>" . "Edit " . "</span>" . "Workers" . "</h2>";


}

?>

<?php

$sql = "SELECT * FROM worker";
$workers = $conn->query($sql);

?>

<div class="editEmployeeMessage">
    <?php

    /*
    if (isset($_COOKIE['addEmployee'])) {
        echo $_COOKIE['addEmployee'];
        setcookie("addEmployee", "", time() - 3600, "/");
    }
    */
    
        if (isset($_COOKIE['editEmployee'])) {
        echo $_COOKIE['editEmployee'];
        setcookie("editEmployee", "", time() - 3600, "/");
        }
    ?>
</div>

<table class="edit">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Admin</th>
    </tr>
    <?php

    foreach ($workers as $worker) {
        echo "<tr>";
        echo "<td>" . $worker["firstName"] . " " . $worker["lastName"] . "</td>";
        echo "<td>" . $worker["email"] . "</td>";
        echo "<td class='admin-option'>" . $worker["admin"] . "</td>";
        echo "<td class='editBtn'><a href='" . URL_ROOT . "/editEmployee/editEmployee.php?workerId=" .
            $worker["workerId"] . "'>Edit</a>"
            . "</td>";
        echo "<td class='editBtn'>" . "<a href='" . URL_ROOT . "/editEmployee/deleteEmployee_process.php?workerId=" . $worker["workerId"] . "'>Delete</a>" . "</td>";


        echo "</tr>";
    }


    ?>
</table>
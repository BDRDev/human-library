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

    echo "<h2 class='workerName'>" . "<span class='welcome'>" . "Edit " . "</span>" . "Worker" . "</h2>";
}

?>

<?php

if (!empty($_GET['workerId'])) {
    $workerId = filter_input(INPUT_GET, "workerId", FILTER_SANITIZE_NUMBER_INT);
}

$sql = "SELECT * FROM worker WHERE workerId=:workerId LIMIT 1";
$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":workerId", $workerId, PDO::PARAM_INT);
$pdoQuery->execute();
$worker = $pdoQuery->fetch(PDO::FETCH_ASSOC);

?>

<form class="editWorker" method="post" action="<?= URL_ROOT ?>/editEmployee/editEmployee_process.php">

    <input type="hidden" name="workerId" value="<?= $worker["workerId"] ?>" required/> <br>

    <label for="firstName_edit" class="">First Name</label>
    <input type="text" name="firstName" id="firstName_edit" value="<?= $worker["firstName"] ?>" required><br>

    <label for="lastName_edit" class="">Last Name</label>
    <input type="text" name="lastName" id="lastName_edit" value="<?= $worker["lastName"] ?>" required><br>

    <label for="email_edit" class="">Email</label>
    <input type="text" name="email" id="email_edit" value="<?= $worker["email"] ?>" required><br>

    <label for="password_edit" class="">Password</label>
    <input type="text" name="password" id="password_edit" value="<?= $worker["password"] ?>" required><br>


    <?php
    if ($worker["admin"] === "yes") {
        ?>
        <label for="#">Admin?</label>
        <div class="admin-decision">
            <input style="vertical-align: middle; margin: 0;" type="radio" name="admin" value="yes" id="yes" checked>
            <label for="yes">Yes</label>
        </div>

        <div class="admin-decision">
            <input style="vertical-align: middle; margin: 0;" type="radio" name="admin" value="no" id="no">
            <label for="no">No</label>
        </div>
        <?php

    } else if ($worker["admin"] === "no") {
        ?>
        <label for="#">Admin?</label>
        <div class="admin-decision">
            <input style="vertical-align: middle; margin: 0;" type="radio" name="admin" value="yes" id="yes">
            <label for="yes">Yes</label>
        </div>

        <div class="admin-decision">
            <input style="vertical-align: middle; margin: 0;" type="radio" name="admin" value="no" id="no" checked>
            <label for="no">No</label>
        </div>
        <?php
    }
    ?>

    <input class="submit" type="submit" value="submit">
</form>


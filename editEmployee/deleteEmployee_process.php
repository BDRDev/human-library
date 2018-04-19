<?php

if(!empty($_GET['workerId'])) {
    $workerId = filter_input(INPUT_GET, "workerId", FILTER_SANITIZE_NUMBER_INT);
}

include_once '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';

$sql = "SELECT * FROM worker WHERE workerId=:workerId";

$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":workerId", $workerId, PDO::PARAM_INT);
$pdoQuery->execute();
$worker = $pdoQuery->fetch(PDO::FETCH_ASSOC);

echo $_COOKIE["workerId"] . "<br>";
echo $workerId;

if($_COOKIE["workerId"] === $worker["workerId"]) {
    //echo "cannot delete self";

    setcookie("editEmployee", "Cannot delete your self", 0, "/");
} else if($worker["email"] === "blaker1136@gmail.com"){
    setcookie("editEmployee", "Cannot delete Blake", 0, "/");
} else {
    $sql = "DELETE FROM worker WHERE workerId=:workerId";

    $pdoQuery = $conn->prepare($sql);
    $pdoQuery->bindValue(":workerId", $workerId, PDO::PARAM_INT);

    if($pdoQuery->execute()) {
        setcookie("editEmployee", "Employee was successfully deleted", 0, "/");
    }
}

header("Location: edit.php");


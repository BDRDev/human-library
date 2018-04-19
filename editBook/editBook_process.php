<?php

include '../_includes/config.php';
include ABSOLUTE_PATH . '/_includes/connection.php';

//variables for the potential new image being uploaded
$uploadOk =1;
$targetDir = ABSOLUTE_PATH . "/assets/images/books/";

$newFileName = strtolower($_FILES["newImage"]["name"]);
$targetFile = $targetDir . $newFileName;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


$bookId = $_POST["bookId"];
$title = $_POST["title"];
$chapters = $_POST["chapters"];
$story = $_POST["story"];
$available = $_POST["available"];

//current image
$bookImage = $_POST["bookImage"];

//new image
$newImage = "assets/images/" . $newFileName;

$alert = $_POST["alert"];
$timeBack = $_POST["timeBack"];

$uploadNewImage = 1;



//checks to see if the newImage variable has something in it
if($_FILES['newImage']['name'] == !"") {
    //if there is something in the variable we will go through all the checks
    //to make sure it is a proper image

    function redirectUsers(){

        //returns users back to the the form
        if($_COOKIE["admin"] === "yes"){
            header("Location: index.php");
        }
        else if($_COOKIE["admin"] === "no") {
            header("Location: ../employee/index.php");
        }
    }


    //check to see if file is an actual image or a fake image
    if(isset($_POST['submit'])){
        $check = getimagesize($_FILES["newImage"]["tmp_name"]);
        if($check !== false){

        } else {
            $uploadOk = 0;
            //sets a cookie telling the user they need to upload an image
            setcookie("imageMessage", "That file is not an image, please select an image and try again", 0, "/");

            //sends users back to the form
            redirectUsers();
        }
    } //ends if statement

    //limit file size
    if($_FILES["newImage"]["size"] > 5000000){
        $uploadOk = 0;
        $sendToDatabase = 0;
        //sets a cookie telling the user that the file size is too large
        setcookie("imageMessage", "Sorry, your file size is too large", 0, "/");

        redirectUsers();
        exit;
    }

    //limit file type
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = 0;
        $sendToDatabase = 0;
        //sets a cookie telling the user that the file already exists
        setcookie("imageMessage", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 0, "/");

        redirectUsers();
        exit;

    }

    if(file_exists($targetFile)){
        $uploadNewImage = 0;
        $sendToDatabase = 0;
        //sets a cookie telling the user that the file already exists
        setcookie("imageMessage", "This file has already been uploaded, please try another", 0, "/");

        redirectUsers();
        exit;


    }

    //Once the check to see if the file is okay to be uploaded, we are going to delete
    //the previous image

    $image = explode('/', $bookImage);
    $toDelete = ABSOLUTE_PATH . '/assets/images/' . $image[2];

    echo $toDelete;

    //deletes the image
    unlink($toDelete);

    //once the image is deleted do one more check to be sure that the
    //the new image file does not exist



    if($uploadOk === 1){
        if(move_uploaded_file($_FILES["newImage"]["tmp_name"], $targetFile)) {
            //file was successfully uploaded
            //setcookie("imageMessage", "Your Image was successfully uploaded", 0, "/");


        }
    }

    //if that all checks out we make the changes
    //$uploadNewImage = 1;
}

//echo "Upload New Image" . $uploadNewImage;
$sql = "UPDATE books SET title=:title, chapters=:chapters, story=:story, available=:available, bookImage=:bookImage, timeBack=:timeBack, alert=:alert WHERE bookId=:bookId";

$pdoQuery = $conn->prepare($sql);
$pdoQuery->bindValue(":title", $title, PDO::PARAM_STR);
$pdoQuery->bindValue(":chapters", $chapters, PDO::PARAM_STR);
$pdoQuery->bindValue(":story", $story, PDO::PARAM_STR);
$pdoQuery->bindValue(":available", $available, PDO::PARAM_STR);

if($_FILES['newImage']['name'] == !"") {
    $pdoQuery->bindValue(":bookImage", $newImage, PDO::PARAM_STR);
} else {
    $pdoQuery->bindValue(":bookImage", $bookImage, PDO::PARAM_STR);
}


if($timeBack === ""){
    //echo "Time back is null";
    $pdoQuery->bindValue(":timeBack", NULL, PDO::PARAM_STR);
} else {
    //echo "Time Back: " . $timeBack;
    $pdoQuery->bindValue(":timeBack", $timeBack, PDO::PARAM_STR);
}

$pdoQuery->bindValue(":alert", $alert, PDO::PARAM_STR);
$pdoQuery->bindValue(":bookId", $bookId, PDO::PARAM_INT);

if($pdoQuery->execute()){
    setcookie("editMessage", "Your edit was successful", 0, "/");
} else {
    setcookie("editMessage", "Your edit was unsuccessful, please try again", 0, "/");
}

header("Location: index.php");

<?php
include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

//all variables for the rest of the form
$title = $_POST["title"];
$story = $_POST["story"];
$chapters = $_POST["chapters"];
$available = $_POST["available"];
$bookImage = "assets/images/" . $newFileName;

$sendToDatabase = 1;

function redirectUsers(){

    //returns users back to the the form
    if($_COOKIE["admin"] === "yes"){
        header("Location: ../admin/index.php");
    }
    //else if($_COOKIE["admin"] === "no") {
        //header("Location: ../employee/index.php");
    //}
}


//check to see if file is an actual image or a fake image
if(isset($_POST['submit'])){
    $check = getimagesize($_FILES["imageUpload"]["tmp_name"]);

    if($check !== false){

        //check if a file exists
        if(file_exists($targetFile)){
            $uploadOk = 0;
            $sendToDatabase = 0;
            //sets a cookie telling the user that the file already exists
            setcookie("imageMessage", "This file has already been uploaded, please try another", 0, "/");

            redirectUsers();
        }

        //limit file size
        if($_FILES["imageUpload"]["size"] > 5000000){
            $uploadOk = 0;
            $sendToDatabase = 0;
            //sets a cookie telling the user that the file size is too large
            setcookie("imageMessage", "Sorry, your file size is too large", 0, "/");

            redirectUsers();
        }

        //limit file type
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $uploadOk = 0;
            $sendToDatabase = 0;
            //sets a cookie telling the user that the file already exists
            setcookie("imageMessage", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 0, "/");

            redirectUsers();
        }


        if($uploadOk === 1){
            if(move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $targetFile)) {
                //file was successfully uploaded
                //setcookie("imageMessage", "Your file was successfully uploaded", 0, "/");

                //returns users back to the the form
                //redirectUsers();
            }
        }

    } else {



    //    / $uploadOk = 0;
        //sets a cookie telling the user they need to upload an image
      //  setcookie("imageMessage", "That file is not an image, please select an image and try again", 0, "/");

        //sends users back to the form
    //    redirectUsers();
    }
    
}


if($sendToDatabase === 1){

    $sql = "INSERT INTO books VALUES (NULL, :title, :story, :chapters, :available, :bookImage, :timeBack, :alert)";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":title", $title, PDO::PARAM_STR);
    $pdoQuery->bindValue(":story", $story, PDO::PARAM_STR);
    $pdoQuery->bindValue(":chapters", $chapters, PDO::PARAM_STR);
    $pdoQuery->bindValue(":available", $available, PDO::PARAM_STR);
    $pdoQuery->bindValue(":bookImage", $bookImage, PDO::PARAM_STR);
    $pdoQuery->bindValue(":timeBack", NULL, PDO::PARAM_STR);
    $pdoQuery->bindValue(":alert", "no", PDO::PARAM_STR);

    if($pdoQuery->execute()){
        setcookie("addBook", "Book was successfully added", 0, "/");
    } else {
        setcookie("addBook", "There was a problem adding the book", 0, "/");
    }

    //returns users back to the the form
    if($_COOKIE["admin"] === "yes"){
        header("Location: ../admin/index.php");
    } else if($_COOKIE["admin"] === "no") {
        header("Location: ../employee/index.php");
    }
}

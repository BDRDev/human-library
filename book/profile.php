<?php

$displayId = $_GET["displayId"];


//Here we check to see if the cookie set when the user logs in matches the
if($displayId === $_COOKIE["bookLoggedIn"]){
    //echo "Display user data <br>";

    include_once '../_includes/config.php';

    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';
    include_once ABSOLUTE_PATH . "/_includes/main_nav.inc.php";
    include_once ABSOLUTE_PATH . '/_includes/connection.php';


    $sql = "SELECT * FROM bookinfo WHERE displayId=:displayId";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

    if($pdoQuery->execute()){
        //echo "Success";

        $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);


        //Below is where we will put the form so the book can edit things
        ?>

        <div class="bookProfileHolder">
        <form class="signUpForm" action="<?= URL_ROOT ?>/book/Update_process.php" method="post">

            <div class="signUpTop">

                <span class="shit">
                <label for="bookFirst">First</label>
                <input id="bookFirst" class="nameInput" name="firstName" value="<?= $row["firstName"] ?>">
                </span>

                <span class="shit">
                <label for="bookLast">Last</label>
                <input id="bookLast" class="nameInput" name="lastName" value="<?= $row["lastName"] ?>"><br>
                </span>
            </div>

            <label for="bookEmail">Email</label>
            <input id="bookEmail" name="email" value="<?= $row["email"] ?>"><br>


            <?php

            //here we will check to see if this is the first time the book id logging in
            //we are going to check to see if there is a row in the bookDisplay table
            //where the two display ids match

            //If there is not a match we will set out blank inputs so that the user can enter their
            //book information

            //if there is a match we will gather all information from that row and place that in the inputs
            //so that the users can update their information.


            $pdoQuery = $conn->prepare("SELECT * FROM bookdisplay WHERE displayId=:displayId");

            $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);


            if($pdoQuery->execute()) {

                $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);

                if ($row === FALSE) {

                    //here is where we will put the blank inputs
                    ?>

                    <label for="bookTitle">Title</label>
                    <input id="bookTitle" name="title"><br>

                    <label for="bookChapters">Chapters</label>
                    <input id="bookChapters" name="chapters"><br>

                    <label for="bookTime">Time</label>
                    <input id="bookTime" name="time"><br><br>


                    <?php

                } else {

                    //This is where we will put the filled in inputs

                    ?>

                    <label for="bookTitle">Title</label>
                    <input id="bookTitle" name="title" value="<?= $row["title"] ?>"><br>

                    <label for="chapters" class="">Chapters</label>
                    <div id="editor" name="editor"></div>
                    <input type="hidden" name="chapters" value="<?= $row["chapters"] ?>"/>

                    <label for="bookTime">Time</label>
                    <input id="bookTime" name="time" value="<?= $row["time"] ?>"><br><br>

                    <?php

                }

            }

?>
            <input type="submit" value="submit">

        </form>
        </div>

        <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

            var form = document.querySelector('.addBook');
            form.onsubmit = function() {
                // Populate hidden form on submit
                var about = document.querySelector('input[name=chapters]');
                about.value = quill.getContents();
            };
        </script>




        <?php

    }


}else {
    echo "You dont have permission to view page";
}
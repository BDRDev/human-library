<?php
include_once '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/header.inc.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';

//This is the random 8 digit pass that is given to a user
//This is what allows them to get to this page to set a password
$setPass = $_GET["setPass"];
$email = "";

$validUser = FALSE;

//echo "This is the setPass from the link: $setPass <br>";

$sql = "SELECT setPass FROM bookInfo";



foreach($conn->query($sql) as $row){
    if($row["setPass"] === $setPass){

        //echo "YES";
        $validUser = TRUE;

        //setcookie("bookSignUp", "valid book", 0);
    }
}

if($validUser === TRUE) {
    //this is where we put all of the stuff to change their password

    $sql = "SELECT * FROM bookInfo WHERE setPass = '$setPass' LIMIT 1";



    //echo "This is the cookie gone: " . $_COOKIE["bookSignUp"] . "<br>";

    //echo $sql;


    foreach($conn->query($sql) as $row){

        $firstName = $row["firstName"];
        $lastName = $row["lastName"];
        $email = $row["email"];

        $_POST["email"] = $email;

    }


    //For the form I need to show first, last, email but not let them change the values here
    //This is just for setting a password
    //Need to add jquery validate to be sure that the two passwords are the same

    ?>

    <div class="bookSignUpHolder">

        <h3 class="signUpHeader">Set Password</h3>

        <div class="fakeInput">

        <div class="fakeLabel">First</div>
        <div class="fakeData"><?= $firstName ?></div>
        </div>

        <div class="fakeInput">
        <div class="fakeLabel">Last</div>
        <div class="fakeData"><?= $lastName ?></div>
        </div>

        <div class="fakeInput">
        <div class="fakeLabel">Email</div>
        <div class="fakeData"><?= $email ?></div>
        </div>


        <form id="bookSignUpForm" class="signUpForm" action="<?= URL_ROOT ?>/book/signUp_process.php" method="post">



            <label for="password">Password</label>
            <input type="password" name="password" id="password" /><br>

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="confirmPassword" id="confirmPassword">


            <input type="submit" value="submit" name="submit">

            <input type="hidden" name="email" id="email" value="<?= $email ?>" />

        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script>
        $(".btn").bind("click", function(e){
            //e.preventDefault();
        });

        $("#bookSignUpForm").validate({

            invalidHandler: function(event, validator) {
                // 'this' refers to the form
                console.log("errors");
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $(".text-muted").hide();
                }
            },

            rules: {

                password: "required",
                confirmPassword: {
                    required: true,
                    equalTo: "#password"
                }
        });

    </script>

    <?php


    //echo "Please add a password";


} else {
    echo "You do not have access to this page";
}





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

$sql = "SELECT setPass FROM bookinfo";



foreach($conn->query($sql) as $row){
    if($row["setPass"] === $setPass){

        //echo "YES";
        $validUser = TRUE;

        //setcookie("bookSignUp", "valid book", 0);
    }
}

if($validUser === TRUE) {
    //this is where we put all of the stuff to change their password

    $sql = "SELECT * FROM bookinfo WHERE setPass = '$setPass' LIMIT 1";

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

        <p>Before we take you to your profile, Set up a password for your account</p>


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

        $(document).ready(function(){
            console.log("hey")
        });



        $("#bookSignUpForm").validate({

            rules: {

                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 15
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#password"
                }
            }


        });

    </script>

    <?php


    //echo "Please add a password";


} else {
    echo "You do not have access to this page";
}





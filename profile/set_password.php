

<?php

include_once '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';
include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

//This is the random 8 digit pass that is given to a user
//This is what allows them to get to this page to set a password
$setPass = $_GET["setPass"];
$email = "";

$validUser = FALSE;


//This will loop through the user table
//If the setPass string 
$sql = "SELECT setPass FROM user";

foreach($conn->query($sql) as $row){
    if($row["setPass"] === $setPass){

        //echo "YES";
        $validUser = TRUE;

        //ends loop if the string is found
        break;
    }
}

if($validUser === TRUE) {
    //this is where we put all of the stuff to change their password

	//gets the email bases off of setPass string
	//going to have the user enter email again just to be sure it is the correct user
    $sql = "SELECT email FROM user WHERE setPass = '$setPass' LIMIT 1";

    foreach($conn->query($sql) as $row){
        $email = $row["email"];
        //echo $email;

    }

    ?>

    <div class="set_passwordHolder">

        <h3 class="set_passwordHeader">Set Password</h3>

        <p>Before we take you to your profile, Set up a password for your account</p>


        <form id="bookSignUpForm" class="signUpForm" action="<?= URL_ROOT ?>/profile/process_password.php" method="post">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="actual_input" data-error='.passwordError'/>
            <div class="passwordError formError"></div>

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="actual_input" data-error='.confirmPasswordError'>
            <div class='confirmPasswordError formError'></div>


            <input type="submit" value="submit" name="submit">

            <input type="hidden" name="email" id="email" value="<?= $email ?>" />

        </form>
    </div>

    <?php
}
    ?>


<script> let page='set_password'</script>
<script src='../build/main.bundle.js'></script>
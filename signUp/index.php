<?php

if ($_COOKIE['admin'] === "yes") {

    include_once '../_includes/config.php';
    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

    include_once ABSOLUTE_PATH . "/_includes/main_nav.inc.php";

    ?>


    <div class="SignUpWrapper">

        <h3 class="signUpHeader">Book Sign Up</h3>

        <form class="signUpForm" action="<?= URL_ROOT ?>/signUp/signUp_process.php" method="post" enctype="multipart/form-data">

            <div class="signUpTop">


                <span class="shit">
                    <label for="fName" class="signUpName">First</label>
                    <input name="fName" id="fName" class="nameInput" value="" required />
                </span>

                <span class="shit">
                    <label for="lName" class="signUpName">Last</label>
                    <input name="lName" id="lName" class="nameInput" value="" required />
                </span>

            </div>

            <label for="email" class="">Email</label>
            <input type="email" name="email" id="email" value="" required />




            <input type="submit" value="Submit" name="submit" />

        </form>


    </div>
<?php

}

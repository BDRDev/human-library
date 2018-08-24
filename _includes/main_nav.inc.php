<?php

//need to have a default thing to show, then add onto it based on the session

//This is if no one is logged in
if(!isset($_SESSION["user_role"])){
?>
    <nav>
            <a id="home" href="<?= URL_ROOT ?>/#homeSection"><img src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>

            <div class="links">
                <a id="book" href="<?= URL_ROOT ?>/#bookSection">Books</a>
                <a class="login" href="<?= URL_ROOT ?>/login/index.php">Login</a>
            </div>
    </nav>
<?php

//This is if there is a user logged in
} else if(isset($_SESSION["user_role"])){


    switch($_SESSION["user_role"]){

        case "book": {
            //echo "There is a book Logged in";

            ?>
             <nav>
                 <a id="home" href="<?= URL_ROOT ?>/#homeSection"><img
                             src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>
                 <div class="links">
                     <a id="book" href="<?= URL_ROOT ?>/#bookSection">Books</a>
                     <a href="<?= URL_ROOT ?>/profile/profile.php?displayId=<?= $_SESSION["user_id"] ?>">Profile</a>
                     <a class="logout" href="<?= URL_ROOT ?>/logout/logout_process.php">Log Out</a>
                 </div>
                 <div>
                 </div>
             </nav>
             <?php

             break;
        }

        case "admin": {
            //echo "There is an Admin logged in";

            ?>
             <nav>
                 <a href="<?= URL_ROOT ?>/index.php"><img src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>
                 <div class="links">
                     <a href="<?= URL_ROOT ?>/employee/index.php">Rent Books</a>
                     <a href="<?= URL_ROOT ?>/editBook/index.php">Edit Books</a>
                     <a href="<?= URL_ROOT ?>/editEmployee/edit.php">Edit Workers</a>
                     <a href="<?= URL_ROOT ?>/signUp/index.php">Sign Up</a>
                     <a href="<?= URL_ROOT ?>/admin/index.php">Admin Page</a>


                     <a class="logout" href="<?= URL_ROOT ?>/logout/logout_process.php">Log Out</a>
                 </div>
             </nav>
             <?php

             break;
        }

        case "worker": {
            ?>
             <nav>
                 <a href="<?= URL_ROOT ?>/index.php"><img src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>
                 <div class="links">
                     <a href="<?= URL_ROOT ?>/employee/index.php">Employee Page</a>
                     <a class="logout" href="<?= URL_ROOT ?>/logout/logout_process.php">Log Out</a>
                 </div>
             </nav>
             <?php

             break;
        }


    }
}









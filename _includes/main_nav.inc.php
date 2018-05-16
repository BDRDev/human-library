<?php

// this is the nav for the users, only shows if no one is logged in
if (!(isset($_SESSION['loggedInUser']))) {
    ?>
    <nav>
        <a id="home" href="<?= URL_ROOT ?>/#homeSection"><img src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>
        <div class="links">
            <a id="book" href="<?= URL_ROOT ?>/#bookSection">Books</a>
            <a class="login" href="<?= URL_ROOT ?>/login/index.php">Login</a>
        </div>
        <div>
            <form action="<?= URL_ROOT ?>/search/index.php" method="get">
                <label for="q">Search:</label>
                <input name="q" id="q" placeholder="search term.."/>
                <input type="submit" value="submit"/>
            </form>
        </div>
    </nav>
    <?php

}

//checks to see if the admin cookie is a thing
 else if (isset($_SESSION['loggedInUser'])) {

     //checks to see if the admin cookie is true
     if ($_SESSION['loggedInUser'] === "admin") {
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
     }

     if ($_SESSION['loggedInUser'] === "employee") {
         ?>

         <nav>
             <a href="<?= URL_ROOT ?>/index.php"><img src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>
             <div class="links">
                 <a href="<?= URL_ROOT ?>/employee/index.php">Employee Page</a>
                 <a class="logout" href="<?= URL_ROOT ?>/logout/logout_process.php">Log Out</a>
             </div>
         </nav>

         <?php
     }

     if (($_SESSION["loggedInUser"] === "book")) {
         ?>
         <nav>
             <a id="home" href="<?= URL_ROOT ?>/#homeSection"><img
                         src="<?= URL_ROOT ?>/assets/images/whiteLogo.svg"></a>
             <div class="links">
                 <a id="book" href="<?= URL_ROOT ?>/#bookSection">Books</a>
                 <a href="<?= URL_ROOT ?>/book/profile.php?displayId=<?= $_SESSION["bookLoggedIn"] ?>">Profile</a>
                 <a class="logout" href="<?= URL_ROOT ?>/logout/logout_process.php">Log Out</a>
             </div>
             <div>
             </div>
         </nav>
         <?php

     }
 }

echo "LoggedInUser: " . $_SESSION["loggedInUser"];
?>

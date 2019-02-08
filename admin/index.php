<?php
//checks to see if the user that is logged in is an admin
//if the user is an admin it loads all the admin content
//if the user is not an admin it shows a blank page

include_once '../_includes/config.php';

if ($_SESSION['user_role'] === "admin") {
    

    include_once('../_includes/constants.php');

    //gets the title from the constants page
    $current_page = $admin_page;
    $page_name = 'admin';

    include_once('../_includes/head.php');
    include_once('../_includes/header.php');
    include_once('../_includes/navigation.php');

    ?>

    <div class="adminSection">
        
        <div id="addEventSection"></div>

        <div id='attendeeListSection'></div>

        <div id='pendingBookSection'></div>

        <div id='pendingLibrarianSection'></div>

        <div id="massEmailSection"></div>

        <div id="listUsersSection"></div>
        
    </div>


    <script>let page = 'admin';</script>

    <script src='../build/main.bundle.js'></script>

    <?php



} //ends if statement

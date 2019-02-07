<?php

    //Blake: Laptop
    //define("ABSOLUTE_PATH", "C:/wamp/www/humanLibrary");

    //Blake: Server
    define("ABSOLUTE_PATH", "/home/users/web/b2088/ipg.blaker113699836/humanlibrary");


    //Blake: Laptop
    //define("URL_ROOT", "http://localhost/humanLibrary");

    //Blake: Server
    define("URL_ROOT", "http://www.humanlibrary.us");



    //this is going to be for the admin email
    //$admin_email = 'blaker1136@gmail.com';

    $admin_email = 'HLIUPUI@iupui.edu';


    include ABSOLUTE_PATH . '/classes/user.class.php';

    //this is going to be a test

    $user = new User();


    include ABSOLUTE_PATH . '/classes/session.class.php';

    $session = new Session();

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
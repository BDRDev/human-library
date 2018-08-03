<?php

    //Blake: Desktop
    //define("ABSOLUTE_PATH", "C:/wamp64/www/humanLibrary");

    //Blake: Laptop
    //define("ABSOLUTE_PATH", "C:/wamp/www/humanLibrary");

    //Blake: Server
    //define("ABSOLUTE_PATH", "/home/users/web/b2088/ipg.blaker113699836");

    define("ABSOLUTE_PATH", "/home/users/web/b2088/ipg.blaker113699836/humanlibrary");

    //Path for Muj: /Applications/MAMP/htdocs/human-library/humanLibrary

    

    // "/home/students/bldrober/public_html/humanLibrary"

    //path for dusty: "dustytome.net"

    //

    //Blake: Desktop
    //define("URL_ROOT", "http://localhost:8383/humanLibrary");

    //Blake: Laptop
    //define("URL_ROOT", "http://localhost/humanLibrary");

    //Blake: Server
    define("URL_ROOT", "http://www.humanlibrary.us");


    //Root for Muj: http://localhost/human-library/humanLibrary

    //Root for Blake: "http://localhost:8383/humanLibrary"
    // "https://in-info-web4.informatics.iupui.edu/~bldrober/humanLibrary"

    //Root for Dusty: "http://dustytome.net/humanLibrary"


if(session_status() === PHP_SESSION_NONE){
    session_start();
}
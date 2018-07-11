<?php


    define("ABSOLUTE_PATH", "C:/wamp64/www/humanLibrary");

    // /home/users/web/b2088/ipg.blaker113699836

    //Path for Muj: /Applications/MAMP/htdocs/human-library/humanLibrary

    //Path for Blake: "C:/wamp64/www/humanLibrary"

    // "/home/students/bldrober/public_html/humanLibrary"

    //path for dusty: "dustytome.net"

///home/users/web/b2088/ipg.blaker113699836/humanlibrary

    define("URL_ROOT", "http://localhost:8383/humanLibrary");

    //http://www.humanlibrary.us


    //Root for Muj: http://localhost/human-library/humanLibrary

    //Root for Blake: "http://localhost:8383/humanLibrary"
    // "https://in-info-web4.informatics.iupui.edu/~bldrober/humanLibrary"

    //Root for Dusty: "http://dustytome.net/humanLibrary"


if(session_status() === PHP_SESSION_NONE){
    session_start();
}
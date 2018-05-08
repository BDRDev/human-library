<?php

//connection.php connects to the database for the website

//variables for the database name, username, and password for the database

/*
$serverName = "localhost";
$database = "humanlib";
$dbusername = "phpuser";
$dbpassword = "phpuser";
*/



$serverName = "blaker113699836.ipagemysql.com";
$database = "humanlib";
$dbusername = "blaker113699836";
$dbpassword = "@Yoyoyo55";



//for dustytome.net
/*
$serverName = "mysql.dustytome.net";
$database = "humanlib";
$dbusername = "hulib_user";
$dbpassword = "whynotHL";
*/

//for web4
/*
$dsn = "mysql:dbname=bldrober_3_db";
$dbUser = "bldrober";
$dbPass = "bldrober";
*/







//try to connect to the database
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$database", $dbusername, $dbpassword);


//for dustytome.net
    //$conn = new PDO($dsn, $dbUser, $dbPass);
    //echo "Connection Successful <br>";

} catch(PDOException $e){
    echo "Connection Failed <br>";
    echo $e->getMessage();
}



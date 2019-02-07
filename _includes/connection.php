<?php

//connection.php connects to the database for the website

//variables for the database name, username, and password for the database


// $serverName = "localhost";
// $database = "humanlib";
// $dbusername = "phpuser";
// $dbpassword = "phpuser";



//This is for the iPage acct
$serverName = "blaker113699836.ipagemysql.com";
$database = "humanlib";
$dbusername = "blaker113699836";
$dbpassword = "@Yoyoyo55";



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

//jennifer johnson


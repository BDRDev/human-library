<?php

class BookLookup {
    //define the database connection object
    private $conn;

    //the constructor. It connects to the MySQL server and select the database for use.
    public function __construct() {
        //for localhost



        $serverName = "localhost";
        $database = "humanlib";
        $dbusername = "phpuser";
        $dbpassword = "phpuser";
        



 //This is for the iPage acct
        // $serverName = "blaker113699836.ipagemysql.com";
        // $database = "humanlib";
        // $dbusername = "blaker113699836";
        // $dbpassword = "@Yoyoyo55";





        //for dustytome.net
/*
        $serverName = "mysql.dustytome.net";
        $database = "humanlib";
        $dbUsername = "hulib_user";
        $dbPassword = "whynotHL";
*/

//for web4
        /*
        $dsn = "mysql:dbname=bldrober_3_db";
        $dbUser = "bldrober";
        $dbPass = "bldrober";
        */




//try to connect to the database
        try {
            $this->conn = new PDO("mysql:host=$serverName;dbname=$database", $dbusername, $dbpassword);

            //for dustytome.net
            //$this->conn = new PDO($dsn, $dbUser, $dbPass);

            //echo "Connection Successful <br>";
        } catch(PDOException $e){
            echo "Connection Failed <br>";
            echo $e->getMessage();
        }
    }

    public function lookup($displayId) {
        $result_array = array();
        $sql = "SELECT * FROM bookdisplay WHERE displayId='$displayId'";



        //execute the query
        $result = $this->conn->query($sql);



        if($result->rowCount()) {
            $result_array = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            $result_array = ["hey"];
        }

        return $result_array;
    }

    public function alert($bookId){
        $result_array = array();
        $sql = "UPDATE books SET alert=:alert WHERE bookId=:bookId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":alert", "yes", PDO::PARAM_STR);
        $pdoQuery->bindValue(":bookId", $bookId, PDO::PARAM_INT);
        $pdoQuery->execute();
    }

    public function rentBook($displayId) {
        $result_array = array();

        date_default_timezone_set('EST');
        $date = new DateTime();
        $date->modify('+70 minutes');
        $timeBack = $date->format('h:i');

        $sql = "SELECT * FROM bookdisplay WHERE displayId=:displayId LIMIT 1";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

        $pdoQuery->execute();

        $result = $pdoQuery->fetch(PDO::FETCH_ASSOC);

        $available = $result["available"];

        if ($available === "yes") {
            $sql = "UPDATE bookdisplay SET available=:available, timeBack=:timeBack WHERE displayId=:displayId";

            $pdoQuery = $this->conn->prepare($sql);

            //this was no
            $pdoQuery->bindValue(":available", "no", PDO::PARAM_STR);
            $pdoQuery->bindValue(":timeBack", $timeBack, PDO::PARAM_STR);
            $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

            $pdoQuery->execute();
        }

        $sql = "SELECT * FROM bookdisplay WHERE displayId='$displayId'";

        //execute the query
        $result = $this->conn->query($sql);

        if($result->rowCount()) {
            $result_array = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            $result_array = ["error" => "Zipcode not found."];
        }

        return $result_array;
    }

    public function returnBook($displayId){
        $sql = "SELECT * FROM bookdisplay WHERE displayId=:displayId LIMIT 1";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

        $pdoQuery->execute();

        $result = $pdoQuery->fetch(PDO::FETCH_ASSOC);

        $available = $result["available"];

        if($available === "no"){
            $sql = "UPDATE bookdisplay SET available=:available, timeBack=:timeBack WHERE displayId=:displayId";

            $pdoQuery = $this->conn->prepare($sql);

            $pdoQuery->bindValue(":available", "yes", PDO::PARAM_STR);
            $pdoQuery->bindValue(":timeBack", NULL, PDO::PARAM_STR);
            $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);

            $pdoQuery->execute();

        }

        $sql = "SELECT * FROM bookdisplay WHERE displayId='$displayId'";

        //execute the query
        $result = $this->conn->query($sql);

        if($result->rowCount()) {
            $result_array = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            $result_array = ["error" => "Zipcode not found."];
        }

        return $result_array;
    }


    public function bookAttendEvent($sliderId){

        $sql = "UPDATE bookinfo SET attendNextEvent=:attendNextEvent WHERE displayId=:sliderId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":attendNextEvent", "yes", PDO::PARAM_STR);
        $pdoQuery->bindValue(":sliderId", $sliderId, PDO::PARAM_INT);

        $pdoQuery->execute();
    }

    public function bookNotAttendEvent($sliderId){

        $sql = "UPDATE bookinfo SET attendNextEvent=:attendNextEvent WHERE displayId=:sliderId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":attendNextEvent", "no", PDO::PARAM_STR);
        $pdoQuery->bindValue(":sliderId", $sliderId, PDO::PARAM_INT);

        if($pdoQuery->execute()) {
            $result_array = "something";
        } else {
            $result_array = ["hey"];
        }

        return $result_array;
    }

}



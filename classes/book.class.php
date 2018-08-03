<?php


//This object is to handle anythign that can be done with the book
//retrieving data, adding data, updating data, adding a new book, deleting a book

//want to retrieve all data, a single piece of data

class Book {
    //define the database connection object
    private $conn;

    //the constructor. It connects to the MySQL server and select the database for use.
    public function __construct() {

        //for localhost
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
            $this->conn = new PDO("mysql:host=$serverName;dbname=$database", $dbusername, $dbpassword);


            //potentially for my iPage acct as well
            //for dustytome.net
            //$this->conn = new PDO($dsn, $dbUser, $dbPass);

            //echo "Connection Successful <br>";
        } catch(PDOException $e){
            echo "Connection Failed <br>";
            echo $e->getMessage();
        } //ends the try catch block

    }//ends constructor

    public function getAllDisplayData($displayId){

        
        $sql = "SELECT * FROM bookdisplay WHERE displayId=:displayId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->execute([':displayId' => $displayId]);

        $user = $pdoQuery->fetch(PDO::FETCH_ASSOC);

        return($user);
    } //ends getAllDisplayData
    


    public function updateSingleValue($displayId, $colChange, $value){

        if($value === 'NULL'){
            $value = NULL;
        }

        $sql = "UPDATE bookdisplay SET " . $colChange . " = :value WHERE displayId=:displayId";
        
        $pdoQuery = $this->conn->prepare($sql);
        
        $pdoQuery->bindParam(':value', $value, PDO::PARAM_STR);
        $pdoQuery->bindParam(':displayId', $displayId, PDO::PARAM_INT);

        if($pdoQuery->execute()){
            
            return($this->getAllDisplayData($displayId));


            echo "success";
        } else {
            echo "idk";
        };
    } //ends updateSingleValue


    public function getBookData($displayId){

        if($displayId == 'all'){
            $sql = "Select bd.title as title, bd.time as time, bd.available as available 
                    FROM bookdisplay bd
                    INNER JOIN bookinfo bi ON bd.displayId = bi.displayId";

            $pdoQuery = $this->conn->query($sql);

            $books = $pdoQuery->fetchAll();

            return($books);
        }

    }

}
<?php


//This object is to handle anythign that can be done with the book
//retrieving data, adding data, updating data, adding a new book, deleting a book

include_once 'connection.class.php';

class Admin extends Connection {
    //define the database connection object
    private $conn;

    //the constructor. It connects to the MySQL server and select the database for use.
    public function __construct() {

        parent::__construct();

        $serverName = $this->serverName;
        $database = $this->database;
        $dbusername = $this->username;
        $dbpassword = $this->password;


        //try to connect to the database
        try {
            $this->conn = new PDO("mysql:host=$serverName;dbname=$database", $dbusername, $dbpassword);

            //echo "Connection Successful <br>";
        } catch(PDOException $e){
            echo "Connection Failed <br>";
            echo $e->getMessage();
        } //ends the try catch block

    }//ends constructor

    public function updateBookDisplay($data, $userId){

        $sql = "UPDATE bookDisplay
                SET 
                    title = :title,
                    chapter_one = :chapter_one,
                    chapter_two = :chapter_two,
                    chapter_three = :chapter_three,
                    available = :available

                WHERE displayId = :displayId
            ";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':title', $data['edit_title'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':chapter_one', $data['edit_chapter_one'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':chapter_two', $data['edit_chapter_two'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':chapter_three', $data['edit_chapter_three'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':available', $data['edit_available'], PDO::PARAM_STR);

        $pdoQuery->bindParam(':displayId', $userId, PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function addBookAttending($userId, $eventId){

        $sql = "INSERT INTO attending VALUES (null, :event_id, :user_id)";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $pdoQuery->bindParam(':event_id', $eventId, PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteBookAttending($userId, $eventId){

        $sql = "DELETE FROM attending WHERE user_id=:userId AND event_id=:eventId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_STR);
        $pdoQuery->bindParam(':eventId', $eventId, PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return true;
        } else {
            return false;
        }
    }

    //adds a new event
    public function addNewEvent($data){

        $sql = "INSERT INTO events VALUES 
        (null, :name, :edate, :event_start, :event_end, :address, :city, :state, :room, :date_added, 5)";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':name', $data['eventName'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':edate', $data['date'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':event_start', $data['startTime'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':event_end', $data['endTime'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':address', $data['address'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':city', $data['city'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':state', $data['state'], PDO::PARAM_STR);
        $pdoQuery->bindParam(':room', $data['room'], PDO::PARAM_STR);
        $pdoQuery->bindValue(":date_added", date("y/m/d"), PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getPendingUsers(){

        $sql = "SELECT * FROM user WHERE role = 'book' AND user_status = 'pending'";

        $pdoQuery = $this->conn->query($sql);

        $users = $pdoQuery->fetchAll();

        return $users;
    }

    public function getPendingLibrarians(){
        $sql = "SELECT * FROM user WHERE role = 'librarian' AND user_status = 'pending'";
        $pdoQuery = $this->conn->query($sql);

        $users = $pdoQuery->fetchAll();

        return $users;
    }

    //approves users who's staus is pending
    public function approveUser($userId){

        $sql = "UPDATE user SET user_status = 'verified' WHERE userId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        
        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_STR);

        if($pdoQuery->execute()){

            return true;
        }
    }

    //declines users who's staus is pending
    public function declineUser($userId){

        $sql = "UPDATE user SET user_status = 'declined' WHERE userId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        
        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

        if($pdoQuery->execute()){

            return true;
        }
    }

    public function getEventUserList($eventId){

        //$sql = "SELECT * FROM attending where event_id=:eventId";

        $sql = "Select user.firstName, user.lastName, user.email, attending.attendId, attending.event_id, user.role
        from user 
        join attending
        on user.userId = attending.user_id
        where attending.event_id = :eventId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->execute([':eventId' => $eventId]);

        $attendees = $pdoQuery->fetchAll();

        return($attendees);
    }



}

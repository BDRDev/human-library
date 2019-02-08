<?php


//This object is to handle anythign that can be done with the book
//retrieving data, adding data, updating data, adding a new book, deleting a book

include 'connection.class.php';

class Book extends Connection {
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

    public function listUsers($role){

        $sql;

        if($role === 'all'){
            $sql = "SELECT * FROM user WHERE role != 'admin'";
        } else {
            $sql = "SELECT * FROM user WHERE role='$role'";
        } 

        $pdoQuery = $this->conn->query($sql);

        $books = $pdoQuery->fetchAll();

        return($books);


    }

    public function addNewEvent($name, $date, $event_start, $event_end, $address, $city, $state, $room){

         $sql = "INSERT INTO events VALUES 
         (null, :name, :edate, :event_start, :event_end, :address, :city, :state, :room, :date_added, null )";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':name', $name, PDO::PARAM_STR);
        $pdoQuery->bindParam(':edate', $date, PDO::PARAM_STR);
        $pdoQuery->bindParam(':event_start', $event_start, PDO::PARAM_STR);
        $pdoQuery->bindParam(':event_end', $event_end, PDO::PARAM_STR);
        $pdoQuery->bindParam(':address', $address, PDO::PARAM_STR);
        $pdoQuery->bindParam(':city', $city, PDO::PARAM_STR);
        $pdoQuery->bindParam(':state', $state, PDO::PARAM_STR);
        $pdoQuery->bindParam(':room', $room, PDO::PARAM_STR);
        $pdoQuery->bindValue(":date_added", date("y/m/d"), PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return("User was successfully added");
        }
    }

    public function getAllBooks(){

        $sql = "SELECT * FROM bookdisplay ORDER BY title";

        $pdoQuery = $this->conn->query($sql);

        $books = $pdoQuery->fetchAll();

        return($books);
    }

    public function getAvailableBooks(){

        $sql = "SELECT * FROM bookdisplay WHERE available = 'yes' ORDER BY title";

        $pdoQuery = $this->conn->query($sql);

        $books = $pdoQuery->fetchAll();

        return($books);

    }

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
        } else {
            $sql = "SELECT * FROM bookdisplay WHERE displayId = :displayId";

            $pdoQuery = $this->conn->prepare($sql);

            //$userId = intval($userId);

            $pdoQuery->bindParam(':displayId', $displayId, PDO::PARAM_INT);

            $pdoQuery->execute();

            $user = $pdoQuery->fetch();

            return $user; 
        }

    }

    public function getLibrarianData($userId){
        $sql = "SELECT * FROM librarian WHERE librarianId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

        $pdoQuery->execute();

        $user = $pdoQuery->fetch();

        return $user;
    }

    public function addToAttending($userId, $eventId){

        $sql = "INSERT INTO attending VALUES (null, :event_id, :user_id)";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $pdoQuery->bindParam(':event_id', $eventId, PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return("User was successfully added");
        }
    }

    public function removeFromAttending($userId, $eventId){

        $sql = "DELETE FROM attending WHERE user_id=:userId AND event_id=:eventId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_STR);
        $pdoQuery->bindParam(':eventId', $eventId, PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return("User was successfully removed");
        }

    }

    public function getAllEvents(){

        $sql = "SELECT * FROM events WHERE date >= CAST(CURRENT_TIMESTAMP AS date)";

        $pdoQuery = $this->conn->query($sql);

        $events = $pdoQuery->fetchAll();

        return($events);
    }

    public function getNextEvent(){

        $sql = "SELECT * FROM events WHERE date >= CAST(CURRENT_TIMESTAMP AS date) LIMIT 1";

        $pdoQuery = $this->conn->query($sql);

        $event = $pdoQuery->fetch();

        return $event;
    }

    public function getOneAttendee($userId){

        $sql = "SELECT * FROM attending WHERE user_id=:userId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->execute([':userId' => $userId]);

        $attendees = $pdoQuery->fetchAll();

        return($attendees);

    }

    public function getEventBookList($eventId){

        //$sql = "SELECT * FROM attending where event_id=:eventId";

        $sql = "Select user.firstName, user.lastName, user.email, attending.attendId, attending.event_id
        from user 
        join attending
        on user.userId = attending.user_id
        where attending.event_id = :eventId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->execute([':eventId' => $eventId]);

        $attendees = $pdoQuery->fetchAll();

        return($attendees);
    }

    public function addEvent($name, $date, $time, $address, $city, $state){

        $sql = "INSERT INTO events VALUES (null, :name, :edate, :etime, :address, :city, :state, null, null )";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':name', $name, PDO::PARAM_STR);
        $pdoQuery->bindParam(':edate', $date, PDO::PARAM_STR);
        $pdoQuery->bindParam(':etime', $time, PDO::PARAM_STR);
        $pdoQuery->bindParam(':address', $address, PDO::PARAM_STR);
        $pdoQuery->bindParam(':city', $city, PDO::PARAM_STR);
        $pdoQuery->bindParam(':state', $state, PDO::PARAM_STR);

        if($pdoQuery->execute()){
            return("User was successfully added");
        }


    }

    public function getCheckedOutBooks(){

        $sql = "SELECT * FROM bookdisplay WHERE available = 'no'";

        $pdoQuery = $this->conn->query($sql);

        $books = $pdoQuery->fetchAll();

        return($books);
    }

    public function returnBook($bookId){

        $sql = "UPDATE bookdisplay SET timeBack = NULL, available = 'yes' WHERE displayId = :displayId";

        $pdoQuery = $this->conn->prepare($sql);
        
        $pdoQuery->bindParam(':displayId', $bookId, PDO::PARAM_INT);

        if($pdoQuery->execute()){

            return "SUCCESS";
        }

        
    }

    public function rentBook($bookId, $timeBack){

        $sql = "UPDATE bookdisplay SET timeBack = :timeBack, available = 'no' WHERE displayId = :displayId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':timeBack', $timeBack, PDO::PARAM_INT);
        $pdoQuery->bindParam(':displayId', $bookId, PDO::PARAM_INT);

        if($pdoQuery->execute()){

            return "SUCCESS";
        }
    }

    public function getUserData($userId){
        $sql = "SELECT * FROM user WHERE userId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        //$userId = intval($userId);

        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

        $pdoQuery->execute();

        $user = $pdoQuery->fetch();

        return $user; 
    }

    public function getUserDataEmail($email){
         $sql = "SELECT * FROM user WHERE email = :email";

        $pdoQuery = $this->conn->prepare($sql);

        //$userId = intval($userId);

        $pdoQuery->bindParam(':email', $email, PDO::PARAM_STR);

        $pdoQuery->execute();

        $user = $pdoQuery->fetch();

        return $user; 

    }

    public function updateUnverifiedUser($userId, $why_book, $book_overview){

        $sql = "UPDATE user SET why_book = :why_book, book_overview = :book_overview, user_status = 'pending' WHERE userId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':why_book', $why_book, PDO::PARAM_STR);
        $pdoQuery->bindParam(':book_overview', $book_overview, PDO::PARAM_STR);
        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

        if($pdoQuery -> execute()){
            return 'success';
        }

    }

    public function updateVerifiedUser($userId, $title, $description, $chapter_one, $chapter_two, $chapter_three, $start_time, $end_time){

        $sql = "UPDATE bookdisplay SET 
            title = :title, 
            description = :description, 
            chapter_one = :chapter_one,
            chapter_two = :chapter_two,
            chapter_three = :chapter_three,
            start_time = :start_time,
            end_time = :end_time
                WHERE displayId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':title', $title, PDO::PARAM_STR);
        $pdoQuery->bindParam(':description', $description, PDO::PARAM_STR);
        $pdoQuery->bindParam(':chapter_one', $chapter_one, PDO::PARAM_STR);
        $pdoQuery->bindParam(':chapter_two', $chapter_two, PDO::PARAM_STR);
        $pdoQuery->bindParam(':chapter_three', $chapter_three, PDO::PARAM_STR);
        $pdoQuery->bindParam(':start_time', $start_time, PDO::PARAM_STR);
        $pdoQuery->bindParam(':end_time', $end_time, PDO::PARAM_STR);
        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

        if($pdoQuery -> execute()){
            return 'success';
        }
    }

    public function updateVerifiedLibrarian($userId, $start_time, $end_time){

         $sql = "UPDATE librarian SET 
            start_time = :start_time,
            end_time = :end_time
                WHERE librarianId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindParam(':start_time', $start_time, PDO::PARAM_STR);
        $pdoQuery->bindParam(':end_time', $end_time, PDO::PARAM_STR);
        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

         if($pdoQuery -> execute()){
            return 'success';
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

    public function updatePendingUser($userId){

        $sql = "UPDATE user SET user_status = 'verified' WHERE userId = :userId";

        $pdoQuery = $this->conn->prepare($sql);

        
        $pdoQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

        if($pdoQuery->execute()){

            return true;
        }
    }

    public function createEmptyBook($displayId){

        $sql = "INSERT INTO bookdisplay (displayId) 
        VALUES (:displayId)";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);
       

        //This will run if the user has selected a unique id and the message was
        //successfully sent
        if ($pdoQuery->execute()) {

            return 'success';

       }
    }

    public function createEmptyLibrarian($displayId){

        $sql = "INSERT INTO librarian (librarianId) 
        VALUES (:displayId)";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":displayId", $displayId, PDO::PARAM_INT);
       

        //This will run if the user has selected a unique id and the message was
        //successfully sent
        if ($pdoQuery->execute()) {

            return 'success';

       }
    }

    public function checkIfAttending($userId, $eventId){

        $sql = "SELECT * FROM `attending` WHERE user_id = :userId AND event_id = :eventId";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":userId", $userId, PDO::PARAM_STR);
        $pdoQuery->bindValue(":eventId", $eventId, PDO::PARAM_STR);

        $pdoQuery->execute();

        $user = $pdoQuery->fetch();

        if($user){
            return true;
        } else {
            return false;
        }
    }

    public function getEmails($role){

        $sql = "SELECT email FROM user WHERE role = :role";

        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":role", $role, PDO::PARAM_STR);

        $pdoQuery->execute();

        $emails = $pdoQuery->fetchAll();

        return $emails;
    }

}


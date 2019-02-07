<?php


//This object is going to be used for signing up and  logging in users
//split it up because these functions are going to be looong

class User {
    //define the database connection object
    private $conn;
    private $userId;
    private $role;

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
        } catch(PDOException $e){
            echo "Connection Failed <br>";
            echo $e->getMessage();
        } //ends the try catch block

    }//ends constructor

    public function signUpUser($first, $last, $email, $password, $role){

        //the first thing we need to do is to check to see if the email the user is trying to sign up with is unique
        $uniqueEmail = $this->uniqueEmail($email);

        

        if(!$uniqueEmail){
            //This is what happens when the user enters an email that is already being used
            return "email";
        } else {

            //This runs if the user has a unique email
            $hashedPw = $this->hashPassword($password);

            //now we have a hashed password and a unique email, next thing we need to do is create a user entry and a book entry
            //$this->createUser($first, $last, $email, $hashedPw);


            $sql = "INSERT INTO user (firstName, lastName, email, dateSignedUp, userId, password, role) 
            VALUES(:firstName, :lastName, :email, :dateSignedUp, NULL, :password, :role)";

            $pdoQuery = $this->conn->prepare($sql);

            $pdoQuery->bindValue(":firstName", $first, PDO::PARAM_STR);
            $pdoQuery->bindValue(":lastName", $last, PDO::PARAM_STR);
            $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
            $pdoQuery->bindValue(":password", $hashedPw, PDO::PARAM_STR);
            $pdoQuery->bindValue(":role", $role, PDO::PARAM_STR);
            $pdoQuery->bindValue(":dateSignedUp", date("y/m/d"), PDO::PARAM_STR);

            //This will run if the user has selected a unique id and the message was
            //successfully sent
            if ($pdoQuery->execute()) {

                return true;

           }
        }
    }

    public function attemptLogin($email, $password){

        //This first sql checks to see if a worker is logging in
        //build sql query to retrieve data
        //$sql = "SELECT * FROM user WHERE email=:email AND password=:password LIMIT 1";

        $sql = "SELECT * FROM user WHERE email=:email LIMIT 1";


        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);

        $pdoQuery->execute();


        if($user = $pdoQuery->fetch(PDO::FETCH_ASSOC)){
             
            if($this->confirmPassword($password, $user['password'])){

                $this->setUserId(44);
                $this->setRole($user['role']);

                return $user;
            } else {
                return 'incorrect email or password';
            }

        } else {
            return 'incorrect email or password';
        }

       
    }

    public function uniqueEmail($email){
        //first thing we need to do is check to see if the email is in the database
        $uniqueEmail = TRUE;

        $sql = "SELECT email FROM user";
        $pdoQuery = $this->conn->prepare($sql);

        $pdoQuery->execute();

        $emails = $pdoQuery->fetchAll();

        //If the email is not unique do not add the stuff to the db and send them back
        //to the form with a cookie that tells them

        foreach($emails as $singleEmail){

            if($singleEmail["email"] === $email){
                $uniqueEmail = FALSE;
                break;
            }
        }

        return $uniqueEmail;
    }

    public function hashPassword($password){

        //hashes the password that the user gave us
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        //here we just check to see if the hashed password and the password are equal, if so we store the hashed pass
        $passwordMatch = password_verify($password, $passwordHash);

        if($passwordMatch) {
            return $passwordHash;
        }

    }

    public function confirmPassword($password, $password2){

        return password_verify($password, $password2);
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getRole(){
        return $this->role;
    }





}
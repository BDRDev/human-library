<?php

include_once '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';

//we get the email and password from the form
$email = $_POST["email"];
$password = $_POST["password"];

//hashes the password that the user gave us
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//echo "Password Hash: " . $passwordHash . "<br><br>";

//here we just check to see if the hashed password and the password are equal, if so we store the hashed pass
$passwordMatch = password_verify($password, $passwordHash);


if($passwordMatch === TRUE) {

    $sql = "UPDATE user 
            SET password = '$passwordHash', setPass = NULL 
            WHERE email = '$email'";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":password", $passwordHash, PDO::PARAM_STR);

    if($pdoQuery->execute()){

    	//echo "It worked";

	 	$sql = "SELECT * FROM user WHERE email=:email";

        $pdoQuery = $conn->prepare($sql);

        $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);

        if($pdoQuery->execute()){

            $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);

            //print_r($row);

            $_SESSION["user_id"] = $row["userId"];
            $_SESSION["user_role"] = $row["role"];

            $userId = $row["userId"];

            //here we know that everything is good to go and we need to send 
            //an email saying that a user's account was created

            //SendTo will be the email that the user provided

            //Need to edit the the

                $sendTo = $admin_email;

                $subject = "To Human Library Admin";

                $message = "
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            
            <table>
            <tr>
            <td>New account was created</td>
            </tr>
            <tr>
                <td>" . $row['firstName'] . " " . $row['lastName'] . "</td>
            </tr>
            <tr>
                <td>" . $row['email'] . "</td>
            </tr>
            <tr>
                <td>Just a reminder, the user just set a password for their account. you will receive another
                email when they submit why they would like to be a book</td>
            </tr>
            </table>
            </body>
            </html>
            ";


                $headers .= "Reply-To: The Sender <sender@domain.com>\r\n";
                $headers .= "Return-Path: The Sender <sender@domain.com>\r\n";
                $headers .= "From: The Sender <sender@domain.com>\r\n";
                $headers .= "Organization: Sender Organization\r\n";
                $headers .= "X-Priority: 3\r\n";
                $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                if(mail($sendTo, $subject, $message, $headers)){


                    $sql = "INSERT INTO user (firstName, lastName, email, userId, setPass) 
                    VALUES(:firstName, :lastName, :email, NULL, :setPass)";

                    $pdoQuery = $conn->prepare($sql);

                    $pdoQuery->bindValue(":firstName", $firstName, PDO::PARAM_STR);
                    $pdoQuery->bindValue(":lastName", $lastName, PDO::PARAM_STR);
                    $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);
                    $pdoQuery->bindValue(":setPass", $setPass, PDO::PARAM_STR);


                    //This will run if the user has selected a unique id and the message was
                    //successfully sent
                    if ($pdoQuery->execute()) {

                        $_SESSION["sign_up_message"] = "Sign up was successful, you will be receiving an email shortly";

                        header("Location: " . URL_ROOT . "/signUp/index.php");

                    };

                } 


            header("Location: " . URL_ROOT . "/profile/profile.php?userId=" . 
            	$userId);

	    }
	}
}
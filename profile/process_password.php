<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

$email = $_POST["email"];
$password = $_POST["password"];

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//echo "Password Hash: " . $passwordHash . "<br><br>";

$passwordMatch = password_verify($password, $passwordHash);


if($passwordMatch === TRUE) {

    $sql = "UPDATE user 
            SET password = '$passwordHash', setPass = NULL 
            WHERE email = '$email'";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":password", $passwordHash, PDO::PARAM_STR);

    if($pdoQuery->execute()){

    	//echo "It worked";

	 	$sql = "SELECT userId, role FROM user WHERE email=:email";

        $pdoQuery = $conn->prepare($sql);

        $pdoQuery->bindValue(":email", $email, PDO::PARAM_STR);

        if($pdoQuery->execute()){

            $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);

            //echo 'worked again';

            $_SESSION["user_id"] = $row["userId"];
            $_SESSION["user_role"] = $row["role"];

            $userId = $row["userId"];


            header("Location: " . URL_ROOT . "/profile/profile.php?userId=" . 
            	$userId);

	    }
	}
}
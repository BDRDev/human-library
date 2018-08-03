<?php

include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';

$first = $_POST["first_name"];
$last = $_POST["last_name"];
$email = $_POST["email"];
//$pass = $_POST["password"];

$title = $_POST["book_title"];
$time = $_POST["book_time"];

$userId = $_SESSION["user_id"];

$profile_update_success = TRUE;

$sql = "UPDATE user
		SET firstName=:first, lastName=:last, email=:email
		WHERE userId=:userId";

$pdoQuery = $conn->prepare($sql);

$pdoQuery->bindValue(':first', $first, PDO::PARAM_STR);
$pdoQuery->bindValue(':last', $last, PDO::PARAM_STR);
$pdoQuery->bindValue(':email', $email, PDO::PARAM_STR);

$pdoQuery->bindValue(':userId', $_SESSION["user_id"], PDO::PARAM_INT);

if($pdoQuery->execute()){
	 
} else {
	$profile_update_success = FALSE;
}



//Here is where we will handle all of the book displayData

$handle_display_data = $_SESSION["profile_display_data"];

if($handle_display_data == 'insert'){

	$sql = "INSERT INTO bookdisplay(displayId, title, chapters, time, timeBack, available)
			VALUES(:displayId, :title, :chapters, :time, :timeBack, :available)";

	$pdoQuery = $conn->prepare($sql);

	$pdoQuery->bindValue(':displayId', $userId, PDO::PARAM_INT);
	$pdoQuery->bindValue(':title', $title, PDO::PARAM_STR);
	$pdoQuery->bindValue(':chapters', NULL, PDO::PARAM_STR);
	$pdoQuery->bindValue(':time', $time, PDO::PARAM_STR);
	$pdoQuery->bindValue(':timeBack', NULL, PDO::PARAM_STR);
	$pdoQuery->bindValue(':available', 'yes', PDO::PARAM_STR);

} else if($handle_display_data == 'update'){

	$sql = "UPDATE bookdisplay
			SET title=:title, chapters=:chapters, time=:time
			WHERE displayId=:displayId";

	$pdoQuery = $conn->prepare($sql);

	$pdoQuery->bindValue(':displayId', $userId, PDO::PARAM_INT);
	$pdoQuery->bindValue(':title', $title, PDO::PARAM_STR);
	$pdoQuery->bindValue(':chapters', NULL, PDO::PARAM_STR);
	$pdoQuery->bindValue(':time', $time, PDO::PARAM_STR);

}

if($pdoQuery->execute()){

} else {
	$profile_update_success = FALSE;
}

if($profile_update_success == TRUE){

	$_SESSION["profile_message"] = "Profile was successfully updated";

	header("Location: " . URL_ROOT . "/profile/profile.php");
}

?>
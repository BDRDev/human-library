<?php
include_once '../_includes/config.php';

include_once ABSOLUTE_PATH . '/_includes/connection.php';
include_once ABSOLUTE_PATH . '/_includes/header.inc.php';
include_once ABSOLUTE_PATH . '/_includes/main_nav.inc.php';


//echo "User ID: " .  $_SESSION["user_id"];
	//echo "User Role: " .  $_SESSION["user_role"]; 

	$user_id = $_SESSION["user_id"];

	//echo $user_id;


	//eventually I want to have a js script that will load all of this for me to avoid mixing js, html, and php
	//use php to get the info
	//js to display it

	//but for now I just want to get it working

	//first thing we need to check for is if its the users first time logging in or not

	//need to check to see if there is a corresponding user Id in the book display table


	//This gets the userInfo
	$sql = "SELECT firstName, lastName, email FROM user WHERE userId=:userId";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":userId", $_SESSION["user_id"], PDO::PARAM_INT);

    if($pdoQuery->execute()){

    $row = $pdoQuery->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);
    //not too sure what will go here
    }

    //here is where want to try to get their displayInfo
    $sql = "SELECT * FROM bookdisplay WHERE displayId=:userId";

    $pdoQuery = $conn->prepare($sql);

    $pdoQuery->bindValue(":userId", $user_id, PDO::PARAM_INT);
    
    if($pdoQuery->execute()){

    	$display_info = $pdoQuery->fetch(PDO::FETCH_ASSOC);

    	//var_dump($display_info);

    	if(!$display_info){
    		//echo "first Time";
    		$_SESSION["profile_display_data"] = "insert";
    	} else {
    		$_SESSION["profile_display_data"] = "update";
    	}

    }



?>


<div class="profile_holder">

	<div class="profile_messages">
	<?php

		if(isset($_SESSION['profile_message'])){

			echo $_SESSION['profile_message'];

			unset($_SESSION['profile_message']);
		}
	?>
	</div>


	<form  class='profile_user_info_form' action="<?= URL_ROOT ?>/profile/profile_process.php" method="post">

		<div>
			<label for='profile_first_name' class=''>First</label>
			<input name='first_name' id="profile_first_name" class="actual_input"
			value="<?= $row["firstName"]  ?>" required />
		</div>

		<div>
			<label for='profile_last_name' class=''>Last</label>
			<input name='last_name' id="profile_last_name" class="actual_input"
			value='<?= $row["lastName"]?>' required />
		</div>

		<div>
			<label for='profile_email' class=''>Email</label>
			<input name='email' id="profile_email" class='' 
			value='<?= $row["email"] ?>' required />
		</div>

		<div>
			<label for='profile_password' class=''>Password</label>
			<input name='password' id="profile_password" class='' />
		</div>


		<!-- Here is where we put the displayInfo part of the form -->


		<div>
			<label for='book_display_title' class=''>Title</label>
			<input name='book_title' id="book_display_title" class='' 
			value='<?= $display_info["title"] ?>' required/>
		</div>

		<div>
			<label for='book_display_time' class=''>Time</label>
			<input name='book_time' id="book_display_time" class='' 
			value='<?= $display_info["time"] ?>' required/>
		</div>
<?php	

	
?>

<input type="submit" value="submit" />


</form>
</div>

<!-- <script>let page = 'profile'</script>
<script src='../build/main.bundle.js'></script> -->

<?php include_once ABSOLUTE_PATH . '/_includes/footer.inc.php'; ?>




<?php
include '../_includes/config.php';
include ABSOLUTE_PATH . '/_includes/connection.php';

include_once ABSOLUTE_PATH . '/_includes/header.inc.php';

include_once '../_includes/main_nav.inc.php';




?>

<div class="formContainer">

	<div class="login_message">
	<?php

		if(isset($_SESSION['login_message'])){

			echo $_SESSION['login_message'];

			unset($_SESSION['login_message']);
		}
	?>
	</div>


    <form class="loginForm" method="post" action="<?= URL_ROOT ?>/login/process_login.php">

        <label for="email" class="formLabel">Username</label>
        <input type="email" name="email" minlength="3" id="email" value="blaker1136@gmail.com"
               required/>

        <label for="password" class="formLabel">Password</label>
        <input type="password" name="password" minlength="3" id="password" value="" required>

        <input class="submit" type="submit" value="Submit">
    </form>
</div>
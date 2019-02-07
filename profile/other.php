<?php
	include_once '../_includes/config.php';


	//include_once ABSOLUTE_PATH . '/_includes/main_nav.inc.php';

	include_once('../_includes/constants.php');

    //gets the title from the constants page
    $current_page = $profile;
    $page_name = 'profile';

    
    include_once('../_includes/head.php');
    include_once('../_includes/header.php');
    include_once('../_includes/test_nav.php');



?>


<div class="profile_holder">


	<div class="profileMessage"></div>
	<div id="unverifiedWrapper"></div>
	<div id="pendingWrapper"></div>

	<div id="fullProfileWrapper">
		<div id="verifiedWrapper"></div>
		<div id="eventWrapper"></div>
	</div>

</div>

<script>let page = 'profile'</script>

<script src='../build/main.bundle.js'></script>



<?php include_once ABSOLUTE_PATH . '/_includes/footer.inc.php'; ?>




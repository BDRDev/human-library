<?php

include_once '../_includes/config.php';

if ($_SESSION['user_role'] === "admin") {

	include_once('../_includes/constants.php');

    //gets the title from the constants page
    $current_page = $admin_page;
    $page_name = 'admin';

    include_once('../_includes/head.php');
    include_once('../_includes/header.php');
    include_once('../_includes/navigation.php');

?>
    <main class="no-section-nav" id="content" role="main">
        <div class="bg-none section">
            <div class="row">
               <!-- <div class="profileLayout layout"> -->
                    <div class="text">
                    

                    <div class="admin_edit_form_wrapper"></div>

                    </div> <!-- -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </main>
    
    <script>let page = 'edit';</script>
    <script src='../build/main.bundle.js'></script>

<?php

}
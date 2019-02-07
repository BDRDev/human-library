<?php

    include '../_includes/config.php';
    include_once('../_includes/constants.php');

    //gets the title from the constants page
    $current_page = $profile;
    $page_name = 'profile';

    include_once('../_includes/head.php');
    include_once('../_includes/header.php');
    include_once('../_includes/test_nav.php');

?>

        <main class="no-section-nav" id="content" role="main">
            <div class="bg-none section">
                <div class="row">
                   <!-- <div class="profileLayout layout"> -->
                        <div class="text">
                                
                                <div class="profile_holder">


                                    <div class="profileMessage"></div>
                                    <div id="unverifiedWrapper"></div>
                                    <div id="pendingWrapper"></div>

                                    <div id="fullProfileWrapper">
                                        <div id="verifiedWrapper"></div>
                                        <div id="eventWrapper"></div>
                                    </div>

                                </div>

                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </main>

    
<?php

    include_once('../_includes/footer.php');
    include_once('../_includes/mobile_nav.php') 

?>

<script>let page = 'profile'</script>

<script src='../build/main.bundle.js'></script>

<!-- Include Javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://assets.iu.edu/web/3.x/js/iu-framework.min.js"></script>
<script src="https://humanlibrary.soic.iupui.edu/assets/js/site.js"></script>


</body>
</html>
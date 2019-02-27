<?php

    include_once '../_includes/config.php';
    include_once ABSOLUTE_PATH . '/_includes/constants.php';

    $current_page = $rent;
    $page_name = 'rent';
    
    include_once ABSOLUTE_PATH . '/_includes/head.php';
    include_once ABSOLUTE_PATH . '/_includes/header.php';
    include_once ABSOLUTE_PATH . '/_includes/navigation.php';

?>
<main class="no-section-nav" id="content" role="main">
    <div class="bg-none section">
        <div class="row" style="max-width: 100rem" >
           <!-- <div class="profileLayout layout"> -->
                <div class="text">
                <div class="rentBooksWrapper">

                    <div class="bookTableWrapper">

                        <table class="rentTable">
                            <tr>
                                <th class="rentTableHeader">Title</th>
                                <th class="rentTableHeader">Available</th>
                                <th class="rentTableHeader">Rent/Return</th>
                            </tr>
                        </table>

                    </div>

                    <div class="rentedBooks">
                        
                    </div>

                </div>

                </div> <!-- -->
                <!-- </div> -->
            </div>
        </div>
</main>

    <script> let page='rent'</script>
    <script src="../build/main.bundle.js"></script>
    <?php




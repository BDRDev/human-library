<?php
//checks to see if the user that is logged in is an admin
//if the user is an admin it loads all the admin content
//if the user is not an admin it shows a blank page

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
            <!-- <div class="row"> -->
               <!-- <div class="profileLayout layout"> -->
                    <div class="text">

                        <div class="adminSection">
                            
                            <div class="adminAddControlSection">
                                <div id="addEventSection">
                                    <div class="sectionHeader">
                                        <h3>Create New Event</h3>
                                    </div>
                                </div>

                                <div id="eventControlSection">
                                    <div class="sectionHeader">
                                        <h3>Event Controller</h3>
                                    </div>
                                    <div id="eventDetailsWrapper"></div>
                                    <div id="daysUntilEventWrapper"></div>
                                    <div id="attendingUsersWrapper"></div>
                                </div>
                            </div>

                            <div class="adminPendingSection">
                                <div id='pendingBookSection'>
                                    <div class="sectionHeader">
                                        <h3>Pending Books</h3>
                                    </div>
                                </div>

                                <div id='pendingLibrarianSection'>
                                    <div class="sectionHeader">
                                        <h3>Pending Librarians</h3>
                                    </div>
                                </div>
                            </div>

                            <div id='attendeeListSection'>
                                <div class="sectionHeader">
                                    <h3>Attendee List</h3>
                                </div>
                            </div>

                            <div id="massEmailSection">
                                <div class="sectionHeader">
                                    <h3>Mass Email</h3>
                                </div>
                            </div>

                            <div id="listUsersSection">
                                <div class="sectionHeader">
                                    <h3>List of Users</h3>
                                </div>
                            </div>
                            
                        </div>

                        </div> <!-- -->
                    <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </main>


    <script>let page = 'admin';</script>

    <script src='../build/main.bundle.js'></script>

    <?php



} //ends if statement

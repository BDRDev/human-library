<?php

  include './_includes/config.php';

  include_once('./_includes/constants.php');

  //gets the title from the constants page
  $current_page = $home;
  $page_name = "home";

  include_once('./_includes/head.php');
  include_once('./_includes/header.php');
  include_once('./_includes/navigation.php');
?>


<!-- <div id='bookSection' class='book'>
    
    <div class="bookDisplayBtns">
        <span class="displayBtns" id="available">Available Books</span>
        <span class="displayBtns" id="all">All Books</span>
    </div>
    <div class='bookDisplay'></div>
</div> -->



<!-- <div id="aboutSection" class="about">
    <h1>IUPUI HUMAN LIBRARY PROJECT</h1>
</div> -->

<!-- <div id="contactSection" class="contact">
    <a target="_blank" href="https://soic.iupui.edu/">IUPUI SCHOOL OF INFORMATICS & COMPUTING</a>

    <a href="https://facebook.com/iupuihumanlibrary" target="_blank">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
   <path id="facebook" fill="#000000" d="M17.252,11.106V8.65c0-0.922,0.611-1.138,1.041-1.138h2.643V3.459l-3.639-0.015
	c-4.041,0-4.961,3.023-4.961,4.961v2.701H10v4.178h2.336v11.823h4.916V15.284h3.316l0.428-4.178H17.252z"></path>
  </svg>

    </a>
</div> -->


<?php
    include_once ABSOLUTE_PATH . '/_includes/footer.php';
?>

<script> let page='home'</script>
<script src="build/main.bundle.js"></script>


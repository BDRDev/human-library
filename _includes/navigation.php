

<nav role="navigation" aria-label="Main" id="nav-main" itemscope="itemscope"
     itemtype="http://schema.org/SiteNavigationElement" class="main show-for-large">
    <ul class="row pad">


        <li class="show-on-sticky first home">

            <a class="<?php if($page_name === 'home'){ echo 'current'; } ?>" 
               href="https://humanlibrary.soic.iupui.edu/" aria-label="Home">

                <span itemprop="name">Home</span>
            </a>
        </li>


        <li>
            <a class="<?php if($page_name === 'about'){ echo 'current'; } ?>" 
               href="https://humanlibrary.soic.iupui.edu/about/">
                <span itemprop="name">About</span>
            </a>
        </li>


        <?php

            if(!isset($_SESSION["user_role"])){
        ?>

        <li>
            <a class="<?php if($page_name === 'volunteer'){ echo 'current'; } ?>" 
               href="<?= URL_ROOT ?>/signUp/signUp.php" itemprop="url">

                <span itemprop="name">Volunteer</span>
            </a>
        </li>

        <?php
            }
        ?>



        <!--li><a href="http://www.humanlibrary.us/#bookSection" itemprop="url"><span itemprop="name">Books</span></a>
        </li-->
        <li>
            <a class="<?php if($page_name === 'contact'){ echo 'current'; } ?>" 
               href="https://humanlibrary.soic.iupui.edu/contact/" itemprop="url">
                <span itemprop="name">Contact Us</span>
            </a>
        </li>

        <?php

            if(!isset($_SESSION["user_role"])){
        ?>

            <li>
                <a class="<?php if($page_name === 'login'){ echo 'current'; } ?>" 
                   href="<?= URL_ROOT ?>/login/login.php">

                    <span itemprop="name">Login</span>
                </a>
            </li>

        <?php
            }
        ?>

        <?php

            if( isset($_SESSION["user_role"]) && $_SESSION['user_role'] === 'admin' ){
        ?>

                <li>
                    <a class="<?php if($page_name === 'admin'){ echo 'current'; } ?>" 
                       href="<?= URL_ROOT ?>/admin/index.php" itemprop="url">
                        <span itemprop="name">Admin</span>
                    </a>
                </li>

                <li>
                    <a>
                        <span class="logoutBtn" itemprop="name">Log Out</span>
                    </a>
                </li>

        <?php
            }
        ?>

        <?php

            if( isset($_SESSION["user_role"]) && $_SESSION['user_role'] != 'admin' ){
        ?>

            <li>
                <a class="<?php if($page_name === 'profile'){ echo 'current'; } ?>"
                   href="/humanlibrary/profile/profile.php" itemprop="url">

                    <span itemprop="name">Profile</span>
                </a>
            </li>

            <li>
               
                    <span class="logoutBtn" itemprop="name">Log Out</span>
      
            </li>

        <?php
            }
        ?>

    </ul>
</nav>


<script> let forNav = 'showing'</script>

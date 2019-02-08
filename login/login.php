<?php 
    
    include_once('../_includes/config.php');
    include_once('../_includes/constants.php');

    //gets the title from the constants page
    $current_page = $login;
    $page_name = 'login';

    include_once('../_includes/head.php');
    include_once('../_includes/header.php');
    include_once('../_includes/navigation.php');

?>

<main class="no-section-nav" id="content" role="main">
    <div class="bg-none section">
        <div class="row">
            <div class="layout">
                <div class="text">
                    <h1>Login</h1>
                    <div class="formContainer">

                        <div class="login_message">
                        </div>

                        <form class="loginForm" method="post" >

                            <label for="email" class="formLabel">Email</label>
                            <input type="email" name="email" minlength="3" id="email" required/>

                            <label for="password" class="formLabel">Password</label>
                            <input type="password" name="password" minlength="3" id="password" required>

                            <input class="button" type="submit" value="Login" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

    include_once('../_includes/footer.php');
    include_once('../_includes/mobile_nav.php') 

?>

<!-- Include Javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://assets.iu.edu/web/3.x/js/iu-framework.min.js"></script>
<script src="https://humanlibrary.soic.iupui.edu/assets/js/site.js"></script>

<script> let page='login'</script>
<script src='../build/main.bundle.js'></script>


</body>
</html>
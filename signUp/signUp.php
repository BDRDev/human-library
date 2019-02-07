
<?php 

    include_once('../_includes/constants.php');

    //gets the title from the constants page
    $current_page = $sign_up;
    $page_name = 'volunteer';

    include_once('../_includes/head.php');
    include_once('../_includes/header.php');
    include_once('../_includes/test_nav.php');

?>

<main class="no-section-nav" id="content" role="main">
    <div class="bg-none section">
        <div class="row">
            <div class="layout">
                <div class="text">
                    <h1>Sign-up</h1>
                    <form class="signUpForm">

                        <div class="signUpTop">

                            <span class="signUpHalf">
                                <label for="fName" class="signUpName">First</label>
                                <input type="text" value="" name="first" id="fName" class="nameInput" data-error="#first-name-error"/>
                                <span class="validation-error" id="first-name-error"></span>
                            </span>

                            <span class="signUpHalf">
                                <label for="lName" class="signUpName">Last</label>
                                <input type="text" value="" name="last" id="lName" class="nameInput" data-error="#last-name-error"/>
                                <span class="validation-error" id="last-name-error"></span>
                            </span>

                        </div>

                        <label for="email" class="">Email</label>
                        <input value="" type="email" name="email" id="email" data-error="#email-error"/>
                        <span class="validation-error" id="email-error"></span>

                        <label for="password" class="">Password</label>
                        <input value="" type="password" name="password" id="password"
                               data-error="#password-error"/>
                        <span class="validation-error" id="password-error"></span>

                        <label for="confirmPassword" class="">Confirm Password</label>
                        <input value="" type="password" name="confirmPassword" id="confirmPassword"
                               data-error="#confirm-password-error"/>
                        <span class="validation-error" id="confirm-password-error"></span>

                        <ul class="no-bullet signUpRole">
                            <li>
                                <input checked type="radio" id="roleBook" name="role" value="book"/>
                                <label for="roleBook">Book</label>
                            </li>
                            <li>
                                <input type="radio" id="roleLibrarian" name="role" value="librarian"/>
                                <label for="roleLibrarian">Librarian</label>
                            </li>
                        </ul>


                        <input type="submit" value="Submit" class="button" name="submit"/>

                    </form>
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

<script> let page='signUp'</script>
<script src='../build/main.bundle.js'></script>


</body>
</html>
<?php
    include_once '../_includes/config.php';
    include_once ABSOLUTE_PATH . '/_includes/header.inc.php';
    include_once ABSOLUTE_PATH . "/_includes/main_nav.inc.php";

?>

    <div id="signUpContainer">
    <div class="signUpWrapper">

        <div class="signUpMessage"></div>

        <h3 class="signUpHeader">IUPUI Human Library Book Signup Form</h3>

        <p class="signUpExplanitation">
            The IUPUI Human Library is an event designed to create positive conversations that challenge stereotypes. During the event, real people are 'loaned' out to have these conversations with other, interested 'readers'. Difficult questions are expected and encouraged.
        </p>

        <p class="signUpInformation">
            For more infomation about the experience, you may want to take a look at 
            <a target="_blank" href="https://humanlibrary.soic.iupui.edu/">humanlibrary.org</a> and reference some of the books at 
            <a target="_blank" href="http://humanlibrary.org/meet-our-human-books/">humanlibrary.org/meet-our-human-books</a>
        </p>

        <form class="signUpForm">

            <div class="signUpTop">


                <span class="signUpHalf">
                    <label for="fName" class="signUpName">First</label>
                    <input value="" name="fName" id="fName" class="nameInput" data-error="#first-name-error" />
                    <span class="validation-error" id="first-name-error"></span>
                </span>

                <span class="signUpHalf">
                    <label for="lName" class="signUpName">Last</label>
                    <input value="" name="lName" id="lName" class="nameInput" data-error="#last-name-error" />
                    <span class="validation-error" id="last-name-error"></span>
                </span>

            </div>

            <label for="email" class="">Email</label>
            <input value="" type="email" name="email" id="email" data-error="#email-error" />
            <span class="validation-error" id="email-error"></span>

            <label for="password" class="">Password</label>
            <input value="" type="password" name="password" id="password" data-error="#password-error" />
            <span class="validation-error" id="password-error"></span>

            <label for="confirmPassword" class="">Confirm Password</label>
            <input value="" type="password" name="confirmPassword" id="confirmPassword" data-error="#confirm-password-error" />
            <span class="validation-error" id="confirm-password-error"></span>

            <ul class="signUpRole">
                <li>
                    <input checked type="radio" id="roleBook" name="role" value="book" />
                    <label for="roleBook">Book</label>
                </li>
                <li>
                    <input type="radio" id="roleLibrarian" name="role" value="librarian" />
                    <label for="roleLibrarian">Librarian</label>
                </li>
            </ul>




            <input type="submit" value="Submit" name="submit" />

        </form>


    </div>


<script> let page='signUp'</script>
<script src='../build/main.bundle.js'></script>

</div>
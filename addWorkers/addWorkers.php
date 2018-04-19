<?php
include_once '../_includes/config.php';
?>

<form class="addWorker" method="post" action="<?= URL_ROOT ?>/addWorkers/addWorkers_process.php">
    <h3>Add a Worker</h3>

    <label for="firstName" class="">First Name</label>
    <input type="text" name="firstName" id="firstName" value="" required/>

    <label for="lastName" class="">Last Name</label>
    <input type="text" name="lastName" id="lastName" value="" required>

    <label for="email" class="">Email</label>
    <input type="email" name="email" id="email" value="" placeholder=" " required>

    <label for="password" class="">Password</label>
    <input type="password" name="password" id="password" value="" placeholder=" " required>

    <label for="#">Admin?</label>

    <div class="admin-decision">
        <input style="vertical-align: middle; margin: 0;" type="radio" name="admin" value="yes" id="yes">
        <label for="yes">Yes</label>
    </div>

    <div class="admin-decision">
        <input style="vertical-align: middle; margin: 0;" type="radio" name="admin" value="no" id="no">
        <label for="no">No</label>
    </div>


    <input class="submit" type="submit" value="Submit">
</form>

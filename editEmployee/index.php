<?php

include_once '../_includes/config.php';
include_once ABSOLUTE_PATH . '/_includes/connection.php';


$sql = "SELECT * FROM worker";
$workers = $conn->query($sql);


echo "<br><br>";

?>

<h3>Edit Workers</h3>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Admin</th>
    </tr>
    <?php

    foreach($workers as $worker){
        echo "<tr>";
        echo "<td>" . $worker["firstName"] . " " . $worker["lastName"] . "</td>";
        echo "<td>" . $worker["email"] . "</td>";
        echo "<td>" . $worker["admin"] . "</td>";
        echo "<td class='editEmployee'>" . "<a href='" . URL_ROOT . "/editEmployee/editEmployee.php?workerId=" . $worker["workerId"] . "'>Edit</a>" . "</td>";


        echo "</tr>";
    }


    ?>
</table>
<?php
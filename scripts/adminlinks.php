<?php
    //a list of links to admin pages
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
?>
<ul>
    <li><a href="adminfeedback.php">view feedback</a></li>
    <li><a href="adminclass.php">view classes</a></li>
    <li><a href="adminuser.php">view Users</a></li>
    <li><a href="admintime.php">view Timeslots</a></li>
</ul>

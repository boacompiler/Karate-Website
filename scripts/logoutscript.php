<?php
    //clears the session and logs the user out
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    die();
?>

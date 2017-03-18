<?php
    session_start();
    if (isset($_POST['submit']))
    {
        echo 'it worked';
    }
    else
    {
        echo 'uh oh';
    }
?> 

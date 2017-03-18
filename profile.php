<?php session_start(); ?> 
<html>
    <body>
        <p>before</p>
    <?php
        echo "your email is " . $_SESSION["email"];
    ?>
        <p>after</p>
    </body>
</html>

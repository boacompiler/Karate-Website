<?php
    //deletes a given user 
    include('base.php');
    $userid = $_POST['userid'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //we want to delete both user and related bookings
    $sql = "DELETE FROM user WHERE userid='$userid';";
    $sqlbooking = "DELETE FROM booking WHERE userid='$userid';";
    if($conn->query($sql) and $conn->query($sqlbooking))
    {
        header("Location: ../adminuser.php");
    }
    else
    {
        echo 'Cannot Delete';
    }
    $conn->close();
?>

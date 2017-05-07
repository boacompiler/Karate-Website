<?php
    //deletes a given class
    include('base.php');
    $classid = $_POST['classid'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //we want to delete both class and related bookings
    $sql = "DELETE FROM class WHERE classid='$classid';";
    $sqlbooking = "DELETE FROM booking WHERE classid='$classid';";
    if($conn->query($sql) and $conn->query($sqlbooking))
    {
        header("Location: ../adminclass.php");
    }
    else
    {
        echo 'Cannot Delete';
    }
    $conn->close();
?>

<?php
    //deletes a given timeslot 
    include('base.php');
    $timeslotid = $_POST['timeslotid'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //we want to delete both class and related bookings
    $sql = "DELETE FROM timeslot WHERE timeslotid='$timeslotid';";
    if($conn->query($sql))
    {
        header("Location: ../admintime.php");
    }
    else
    {
        echo 'Cannot Delete';
    }
    $conn->close();
?>

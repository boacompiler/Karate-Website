<?php
    include('base.php');
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $timeslotid = $_POST['timeslotid'];
    $starthours = $_POST['starthours'];
    $startminutes= $_POST['startminutes'];
    $endhours = $_POST['endhours'];
    $endminutes= $_POST['endminutes'];
    $room = $_POST['room'];
    $day = $_POST['day'];
    
    $timebegin = $starthours.":".$startminutes.":00"; 
    $timeend = $endhours.":".$endminutes.":00"; 

    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="UPDATE timeslot SET timebegin = '$timebegin', timeend = '$timeend', room = '$room', day = '$day' WHERE timeslotid = '$timeslotid';";
    if($conn->query($sql))
    {
        header("Location: ../admintime.php");
    }
    else
    {
        echo 'Cannot update';
    }
    $conn->close();
?>

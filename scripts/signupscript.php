<?php
    session_start();
    $conn=new mysqli("localhost","root","password","website");
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $signupclassid = $_POST['signupclassid'];
    $userid = $_SESSION['userid'];
    if($signupclassid == '' or $userid == '')
    {
        echo "credential error";
    }
    else
    {
        $sql = "INSERT INTO `booking` (`userid`, `classid`) VALUES ('$userid', '$signupclassid');";
        if($conn->query($sql))
        {
            header("Location: ".$_SESSION['page']);
        }
        else
        {
            echo "Database Failure";
        }
    }
    $conn->close();
?>

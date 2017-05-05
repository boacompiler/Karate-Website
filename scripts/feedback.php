<?php
    //allows a user to submit feedback
    include('base.php');
    $feedback=$_POST['body'];
    $user=0;//this uses the special anonymouse user
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $_feedback= mysqli_real_escape_string($conn,$feedback);
    if(isset($_SESSION['loggedin']))
    { 
        //if the user is logged in, we assign their id to the feedback
        $user=$_SESSION['userid'];
    }
    $sql = "INSERT INTO `feedback` (`feedback`,`userid`) VALUES ('$_feedback','$user');";
    if( $conn->query($sql))
    {
        $_SESSION['errorfeedback'] = 'Thank you for your feedback!';
        header("Location: ../contact.php");
    }
    else
    {
        $_SESSION['errorfeedback'] = 'Failed to submit feedback, please try again later';
        header("Location: ../contact.php");
    }
    die();
?> 

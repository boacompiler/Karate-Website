<?php
    session_start();
    $email=$_POST['email'];
    $password=$_POST['password'];
    $firstname=$_POST['firstname'];
    $secondname=$_POST['secondname'];
    $dob=$_POST['dob'];
    $conn=new mysqli("localhost","root","password","website"); 
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE email='$email'";
    $checkemail = $conn->query($sql);
    if($checkemail->num_rows >= 1)
    {
        echo "uh oh";
    }
    else
    {
        echo "worked";
    } 
    echo "finish";
    $conn->close();
    die();
?>
